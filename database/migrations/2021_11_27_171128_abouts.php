<?php

use App\Enums\GalleryType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Abouts extends Migration
{

    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid("image_uuid")->constrained("files")->nullable();
            $table->bigInteger('about_category_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('about_category_id')->references('id')->on('about_categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('abouts');
    }
}
