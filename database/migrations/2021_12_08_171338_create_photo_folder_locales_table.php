<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoFolderLocalesTable extends Migration
{

    public function up()
    {
        Schema::create('photo_folder_locales', function (Blueprint $table) {
            $table->uuid("id")->primary()->unique()->index();
            $table->foreignId("photo_folder_id")->constrained("photo_folders")->nullable()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('local' , 3)->default('az');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('photo_folder_locales');
    }
}
