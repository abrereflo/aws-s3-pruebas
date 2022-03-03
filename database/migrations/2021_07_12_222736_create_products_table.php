<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_families_id')->constrained('product_families');
            $table->string('code', 150)->unique();
            $table->string('name', 200)->unique();
            $table->string('image',250);
            $table->string('description');
            $table->double('cost', 8,2);
            $table->double('salePrice', 8,2);
            $table->double('invoicePrice', 8,2);
            $table->integer('stock');
            $table->boolean('statu')->default(true);
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
        Schema::dropIfExists('products');
    }
}
