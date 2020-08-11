<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('project_id')->unique();
            $table->string('project_title');
            $table->longText('project_description');
            $table->integer('project_user');
            $table->integer('project_image');
            $table->timestamp('project_created_at', 0)->nullable();
            $table->timestamp('project_completed_at', 0)->nullable();
            $table->timestamp('project_approved_at', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
