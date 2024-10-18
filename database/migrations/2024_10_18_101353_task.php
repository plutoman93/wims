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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('task_id'); //แก้การประกาศ PrimaryKey
            $table->string('task_name');
            $table->string('task_type'); //ชนิดงาน ?? หรือ type name ?
            $table->string('task_detail',100);
            $table->string('start_date');
            $table->string('due_date');
            $table->string('file',2048)->nullable();
            $table->foreignId('task_status_id')->index();
            $table->foreignId('type_id')->index();
            $table->foreignId('user_id')->index();
            $table->timestamp('created_by')->nullable();;
            $table->timestamp('updated_by')->nullable();;
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
