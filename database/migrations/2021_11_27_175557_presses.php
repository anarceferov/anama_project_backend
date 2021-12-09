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
            $table->foreignUuid("file_uuid")->constrained("files")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('presses');
    }
}
