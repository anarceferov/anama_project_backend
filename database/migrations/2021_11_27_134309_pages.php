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
            $table->string('key')->unique()->nullable();
            $table->integer('is_active')->default(0);
            $table->foreignUuid("image_uuid")->nullable()->constrained("files");
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
