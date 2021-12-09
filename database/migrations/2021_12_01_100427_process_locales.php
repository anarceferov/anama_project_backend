<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProcessLocales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_locales', function (Blueprint $table) {
            $table->uuid("id")->primary()->unique()->index();
            $table->foreignId("process_id")->constrained("processes")->nullable()->onDelete('cascade');
            $table->longText('text')->nullable();
            $table->string('local' , 3)->default('az');
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
        Schema::dropIfExists('process_locales');
    }
}
