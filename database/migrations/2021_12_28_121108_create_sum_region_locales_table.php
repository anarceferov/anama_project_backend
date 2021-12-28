<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSumRegionLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sum_region_locales', function (Blueprint $table) {
            $table->uuid("id")->primary()->unique()->index();
            $table->string('local', 3)->default('az');
            $table->foreignId("sum_region_id")->constrained("sum_regions")->onDelete('cascade');
            $table->longText('text')->nullable();
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
        Schema::dropIfExists('sum_region_locales');
    }
}
