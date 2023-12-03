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
        // TODO add logic to fi-resource that renders this enums based
        // only on current product qty and make field disabled
        // or
        // remove that field and show status only in admin panel
        // based on current qty <- best solution

        // 🧠 Do not forget remove status column from seeder
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->enum('status', ['in-stock', 'out-of-stock', 'only-a-few-remaining', 'only-pre-order', 'discontinued']);
        });
    }
};
