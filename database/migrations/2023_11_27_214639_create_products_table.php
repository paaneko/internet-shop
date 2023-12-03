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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained()
                ->nullOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->string('image_url')->nullable();
            $table->string('meta_tag_h1')->nullable();
            $table->string('meta_tag_title')->nullable();
            $table->text('meta_tag_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('product_code')->nullable();
            $table->string('SKU')->nullable();
            $table->string('UPC')->nullable();
            $table->string('EAN')->nullable();
            $table->string('JAN')->nullable();
            $table->string('MPN')->nullable();
            $table->integer('price')->default(0);
            $table->smallInteger('count')->default(0);
            $table->enum(
                'status',
                ['in-stock', 'out-of-stock', 'only-pre-order', 'discontinued']
            );
            $table->boolean('indexation');
            $table->timestamps();
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
