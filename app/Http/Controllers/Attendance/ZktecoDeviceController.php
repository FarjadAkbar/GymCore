<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Services\Attendance\AttendanceRecorder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * ZKTeco / eSSL ADMS push endpoints (iClock protocol).
 */
class ZktecoDeviceController extends Controller
{
    public function __construct(
        private readonly AttendanceRecorder $recorder,
    ) {}

    public function cdata(Request $request): Response
    {
        if (! config('attendance.device_enabled', true)) {
            return response('OK', 200);
        }

        if (! $this->deviceAuthorized($request)) {
            return response('Unauthorized', 401);
        }

        if ($request->isMethod('GET')) {
            return response("GET OPTION FROM: 1\nStamp=9999\nOpStamp=9999\nErrorDelay=30\nDelay=10\nTransTimes=00:00;14:00\nTransInterval=1\nTransFlag=AttLog\tOpLog\tEnrollUser\tChgUser\tEnrollFP\tChgFP\nRealtime=1\nEncrypt=0\n", 200);
        }

        if (Str::lower((string) $request->query('table')) !== 'attlog') {
            return response("OK\n", 200);
        }

        $deviceSerial = (string) $request->query('SN', '');
        $body = trim((string) $request->getContent());

        if ($body !== '') {
            foreach (preg_split('/\r\n|\r|\n/', $body) ?: [] as $line) {
                $line = trim($line);

                if ($line === '') {
                    continue;
                }

                $this->parseAttlogLine($line, $deviceSerial);
            }
        }

        return response("OK\n", 200);
    }

    public function getrequest(Request $request): Response
    {
        if (! config('attendance.device_enabled', true)) {
            return response('OK', 200);
        }

        if (! $this->deviceAuthorized($request)) {
            return response('Unauthorized', 401);
        }

        return response("OK\n", 200);
    }

    private function parseAttlogLine(string $line, string $deviceSerial): void
    {
        $parts = preg_split("/\t+/", $line) ?: [];

        if (count($parts) < 2) {
            return;
        }

        $deviceUserId = trim($parts[0]);
        $punchedAtRaw = trim($parts[1]);

        if ($deviceUserId === '' || $punchedAtRaw === '') {
            return;
        }

        try {
            $punchedAt = Carbon::parse($punchedAtRaw);
        } catch (\Throwable) {
            return;
        }

        $statusCode = isset($parts[2]) ? (int) $parts[2] : null;
        $verifyType = isset($parts[3]) ? (int) $parts[3] : null;

        $this->recorder->record(
            deviceUserId: $deviceUserId,
            punchedAt: $punchedAt,
            source: 'zkteco',
            deviceSerial: $deviceSerial !== '' ? $deviceSerial : null,
            verifyType: $verifyType,
            statusCode: $statusCode,
            rawPayload: ['line' => $line],
        );
    }

    private function deviceAuthorized(Request $request): bool
    {
        $expected = config('attendance.device_comm_key');

        if (blank($expected)) {
            return true;
        }

        $provided = $request->query('key')
            ?? $request->header('X-Attendance-Key')
            ?? $request->input('key');

        return hash_equals((string) $expected, (string) $provided);
    }
}
