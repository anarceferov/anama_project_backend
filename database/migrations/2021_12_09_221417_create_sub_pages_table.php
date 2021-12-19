<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubPagesTable extends Migration
{
    
    public function up()
    {
        Schema::create('sub_pages', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->nullable();
            $table->integer('is_active')->default(0);
            $table->bigInteger('page_id')->unsigned();

            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('sub_pages');
    }
}
