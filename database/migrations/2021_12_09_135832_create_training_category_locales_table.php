<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingCategoryLocalesTable extends Migration
{

    public function up()
    {
        Schema::create('training_category_locales', function (Blueprint $table) {
            $table->uuid("id")->primary()->unique()->index();
            $table->string('name');
            $table->foreignId("training_category_id")->constrained("training_categories")->nullable()->onDelete('cascade');
            $table->string('local' , 3)->default('az');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('training_category_locales');
    }
}
