<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid("image_uuid")->constrained("files")->nullable(); 
            $table->bigInteger('all_project_category_id')->unsigned();
            $table->timestamps();

            $table->foreign('all_project_category_id')->references('id')->on('all_project_categories')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('all_projects');
    }
}
