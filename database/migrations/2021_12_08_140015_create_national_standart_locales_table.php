<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationalStandartLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('national_standart_locales', function (Blueprint $table) {
            $table->uuid("id")->primary()->unique()->index();
            $table->foreignId("national_standart_id")->constrained("national_standarts")->nullable()->onDelete('cascade');
            $table->string('local' , 3)->default('az');
            $table->longText('text');
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
        Schema::dropIfExists('national_standart_locales');
    }
}
