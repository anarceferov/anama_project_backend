<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pages extends Migration
{

    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->integer('is_active')->default(0);
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
