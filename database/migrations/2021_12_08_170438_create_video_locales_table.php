<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_locales', function (Blueprint $table) {
            $table->uuid("id")->primary()->unique()->index();
            $table->string('title');
            $table->foreignId("video_id")->constrained("videos")->onDelete('cascade');
            $table->string('local', 3)->default('az');
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
        Schema::dropIfExists('video_locales');
    }
}
