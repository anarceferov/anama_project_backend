<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AboutLocales extends Migration
{

    public function up()
    {
        Schema::create('about_locales', function (Blueprint $table) {
            $table->uuid("id")->primary()->unique()->index();
            $table->foreignId("about_id")->constrained("abouts")->nullable()->onDelete('cascade');
            $table->longText('text')->nullable();
            $table->string('local' , 3)->default('az');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('about_locales');
    }
}
