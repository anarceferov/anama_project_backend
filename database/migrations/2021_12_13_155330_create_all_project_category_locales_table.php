<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllProjectCategoryLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_project_category_locales', function (Blueprint $table) {
            $table->uuid("id")->primary()->unique()->index();
            $table->string('local', 3)->default('az');
            $table->foreignId("all_project_category_id")->constrained("all_project_categories")->onDelete('cascade');
            $table->string('name')->nullable();
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
        Schema::dropIfExists('all_project_category_locales');
    }
}
