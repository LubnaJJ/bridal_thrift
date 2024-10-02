<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
     
        $table->unsignedBigInteger('business_id'); // Foreign key to businesses table

        $table->string('name');
        $table->text('description');
        $table->integer('quantity');
        $table->decimal('price', 8, 2);
        $table->string('image'); // Store image file path
        $table->timestamps();

        // Foreign key constraint
        $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
