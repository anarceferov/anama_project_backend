<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubPageLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_page_locales', function (Blueprint $table) {
            $table->uuid("id")->primary()->unique()->index();
            $table->foreignId("sub_page_id")->constrained("sub_pages")->onDelete('cascade');
            $table->string('name')->nullable();
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
        Schema::dropIfExists('sub_page_locales');
    }
}
