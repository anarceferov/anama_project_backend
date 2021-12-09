<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsCategoryLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_category_locales', function (Blueprint $table) {
            $table->uuid("id")->primary()->unique()->index();
            $table->string('name');
            $table->foreignId("news_category_id")->constrained("news_categories")->onDelete('cascade');
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
        Schema::dropIfExists('news_category_locales');
    }
}
