<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('entity_id');
            $table->string('category_name');
            $table->string('sku', 100);
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('short_description');
            $table->decimal('price', 10, 4);
            $table->string('link');
            $table->string('image');
            $table->string('brand');
            $table->tinyInteger('rating')->unsigned()->nullable();
            $table->tinyText('caffeine_type')->nullable();
            $table->integer('count')->nullable();
            $table->tinyText('flavored')->nullable();
            $table->enum('seasonal', ['Yes', 'No'])->nullable();
            $table->enum('instock', ['Yes', 'No'])->default('No');
            $table->enum('facebook', ['0', '1'])->default('0');
            $table->enum('is_kc_up', ['0', '1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
