<?php

use App\Enums\GalleryType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Processes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->longText('text')->nullable();
            $table->longText('text_en')->nullable();
            $table->foreignUuid("image_uuid")->constrained("files");
            $table->smallInteger("status")->default(config("defaults.statuses.active"));
            $table->smallInteger("type")->default(GalleryType::PHOTO);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('processes');
    }
}
