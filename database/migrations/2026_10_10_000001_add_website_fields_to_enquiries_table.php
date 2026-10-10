<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->string('father_name')->nullable()->after('name');
            $table->foreignId('plan_id')->nullable()->after('contact')->constrained()->nullOnDelete();
        });

        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('enquiries', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropConstrainedForeignId('plan_id');
            $table->dropColumn('father_name');
        });

        Schema::table('enquiries', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }
};
