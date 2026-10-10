<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Device integration
    |--------------------------------------------------------------------------
    |
    | Most ZKTeco / eSSL devices push logs to /iclock/cdata when configured
    | with your server URL. Set ATTENDANCE_DEVICE_ENABLED=false to disable
    | unauthenticated device endpoints.
    |
    */

    'device_enabled' => env('ATTENDANCE_DEVICE_ENABLED', true),

    'device_comm_key' => env('ATTENDANCE_DEVICE_COMM_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Punch handling
    |--------------------------------------------------------------------------
    */

    'dedupe_minutes' => (int) env('ATTENDANCE_DEDUPE_MINUTES', 15),

    'match_member_by' => ['attendance_device_user_id', 'code'],

];
