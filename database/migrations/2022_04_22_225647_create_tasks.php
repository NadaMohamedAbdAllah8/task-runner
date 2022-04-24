<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('random_id');

            $table->string('project_id');
            $table->foreign('project_id')->references('id')->on('projects');

            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('task_statuses');

            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('task_types');

            $table->string('file_name');
            $table->string('file_path');

            $table->integer('no_of_occurrences')->nullable();

            $table->timestamp('started_at')->nullable();

            $table->timestamp('ended_at')->nullable();

            $table->text('failure_reason')->nullable()->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
