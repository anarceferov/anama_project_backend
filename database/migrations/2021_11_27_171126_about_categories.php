<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AboutCategories extends Migration
{

    public function up()
    {
        Schema::create('about_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('date')->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_categories');
    }
}
