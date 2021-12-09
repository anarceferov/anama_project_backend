<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsLocalesTable extends Migration
{

    public function up()
    {
        Schema::create('news_locales', function (Blueprint $table) {
            $table->uuid("id")->primary()->unique()->index();
            $table->foreignId("news_id")->constrained("news")->nullable()->onDelete('cascade');
            $table->string('title')->nullable();
            $table->longText('text')->nullable();
            $table->string('local' , 3)->default('az');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_locales');
    }
}
