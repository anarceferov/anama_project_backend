<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_locales', function (Blueprint $table) {
            $table->uuid("id")->primary()->unique()->index();
            $table->string('local', 3);
            $table->foreignId("region_id")->constrained("regions")->onDelete('cascade');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('region_locales');
    }
}
