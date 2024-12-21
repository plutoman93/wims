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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); //Column ตามตาราง <--
            $table->string('username', 255);
            $table->foreignId('title_id')->nullable()->index();
            $table->string('first_name', 20)->nullable();
            $table->string('last_name', 20)->nullable();
            $table->foreignId('department_id')->nullable()->index();
            $table->foreignId('faculty_id')->nullable()->index();
            $table->string('phone')->nullable();
            $table->string('photo', 2048)->nullable();
            $table->string('email')->unique();
            $table->foreignId('account_status_id')->nullable()->index();
            $table->foreignId('user_status_id')->nullable()->index();
            $table->foreignId('created_by')->comment('สร้างโดย user_id')->nullable();
            $table->foreignId('updated_by')->comment('แก้ไขโดย user_id')->nullable();
            $table->foreignId('deleted_by')->comment('ลบโดย user_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
