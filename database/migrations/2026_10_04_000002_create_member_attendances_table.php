<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('member_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->nullable()->constrained()->nullOnDelete();
            $table->string('device_user_id', 64);
            $table->timestamp('punched_at');
            $table->string('direction', 16)->nullable();
            $table->string('device_serial', 64)->nullable();
            $table->unsignedTinyInteger('verify_type')->nullable();
            $table->unsignedTinyInteger('status_code')->nullable();
            $table->string('source', 32);
            $table->json('raw_payload')->nullable();
            $table->timestamps();

            $table->index(['member_id', 'punched_at']);
            $table->index(['device_user_id', 'punched_at']);
            $table->unique(['device_serial', 'device_user_id', 'punched_at'], 'member_attendances_device_punch_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_attendances');
    }
};
