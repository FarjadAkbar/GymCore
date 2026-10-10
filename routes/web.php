<?php

use App\Http\Controllers\Attendance\ZktecoDeviceController;
use App\Http\Controllers\InvoiceDocumentController;
use App\Http\Controllers\Website\EnquiryController;
use App\Http\Controllers\Website\HomeController;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('website.home');
Route::get('/join', [EnquiryController::class, 'create'])->name('website.enquiry.create');
Route::post('/join', [EnquiryController::class, 'store'])->name('website.enquiry.store');

Route::prefix('iclock')->group(function (): void {
    Route::match(['get', 'post'], '/cdata', [ZktecoDeviceController::class, 'cdata']);
    Route::match(['get', 'post'], '/cdata.aspx', [ZktecoDeviceController::class, 'cdata']);
    Route::match(['get', 'post'], '/getrequest', [ZktecoDeviceController::class, 'getrequest']);
    Route::match(['get', 'post'], '/getrequest.aspx', [ZktecoDeviceController::class, 'getrequest']);
});

Route::middleware([Authenticate::class])
    ->group(function (): void {
        Route::get('/invoices/{invoice}/preview', [InvoiceDocumentController::class, 'preview'])
            ->name('invoices.preview');

        Route::get('/invoices/{invoice}/download', [InvoiceDocumentController::class, 'download'])
            ->name('invoices.download');
    });
