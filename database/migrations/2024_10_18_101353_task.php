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
            $table->text('task_detail');
            $table->date('start_date');
            $table->date('due_date');
            $table->foreignId('task_status_id')->references('task_status_id')->on('task_statuses');
            $table->foreignId('type_id')->index();
            $table->foreignId('user_id')->index();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->comment('ลบโดย user_id')->nullable();
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
