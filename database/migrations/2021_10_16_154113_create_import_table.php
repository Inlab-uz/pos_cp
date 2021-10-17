<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('discount_id')->nullable();
            $table->string('measure')->nullable();
            $table->double('quantity',6,2)->nullable();
            $table->double('part',6,2)->nullable();
            $table->double('price',15,2)->nullable();
            $table->double('sale_price',15,2)->nullable();
            $table->double('nds',15,2)->nullable();
            $table->timestamp('date_produce')->nullable();
            $table->timestamp('date_expire')->nullable();
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
        Schema::dropIfExists('import');
    }
}
