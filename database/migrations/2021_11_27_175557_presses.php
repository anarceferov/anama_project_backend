<?php

use App\Enums\GalleryType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Presses extends Migration
{

    public function up()
    {
        Schema::create('presses', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable(); // date make
            $table->string('title')->nullable();
            $table->string('title_en')->nullable();
            $table->foreignUuid("file_uuid")->constrained("files");
            $table->smallInteger("status")->default(config("defaults.statuses.active"));
            $table->smallInteger("type")->default(GalleryType::PHOTO);
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('presses');
    }
}
