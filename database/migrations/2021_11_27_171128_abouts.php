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
            $table->integer('date')->nullable();
            $table->longText('text')->nullable();
            $table->longText('text_en')->nullable();
            $table->foreignUuid("image_uuid")->constrained("files");
            $table->smallInteger("status")->default(config("defaults.statuses.active"));
            $table->smallInteger("type")->default(GalleryType::PHOTO);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('abouts');
    }
}
