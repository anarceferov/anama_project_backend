<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacancyLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_locales', function (Blueprint $table) {
            $table->uuid("id")->primary()->unique()->index();
            $table->string('local', 3);
            $table->foreignId("vacancy_id")->constrained("vacancies")->onDelete('cascade');
            $table->longText('text')->nullable();
            $table->string('title')->nullable();
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
        Schema::dropIfExists('vacancy_locales');
    }
}
