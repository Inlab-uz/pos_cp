<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsGlobalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_global', function (Blueprint $table) {
            $table->id();
            $table->string("barcode_number",20)->nullable();
            $table->string("barcode_formats")->nullable();
            $table->string("title")->nullable();
            $table->string("brand")->nullable();
            $table->string("model")->nullable();
            $table->string("manufacturer")->nullable();
            $table->string("category")->nullable();
            $table->longText("description")->nullable();
            $table->longText("images")->nullable();
            $table->string("ingredients")->nullable();
            $table->string("age_group")->nullable();
            $table->string("nutrition_facts")->nullable();
            $table->string("energy_efficiency_class")->nullable();
            $table->string("color")->nullable();
            $table->string("gender")->nullable();
            $table->string("material")->nullable();
            $table->string("pattern")->nullable();
            $table->string("format")->nullable();
            $table->string("multipack")->nullable();
            $table->string("size",90)->nullable();
            $table->string("length",90)->nullable();
            $table->string("width",90)->nullable();
            $table->string("height",90)->nullable();
            $table->string("weight",90)->nullable();
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
        Schema::dropIfExists('products_global');
    }
}
