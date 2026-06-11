<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->string('brand')->nullable();

            $table->string('storage')->nullable();

            $table->string('color')->nullable();

            $table->string('display_size')->nullable();

            $table->string('condition')->nullable();

            $table->string('discount')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn([

                'brand',
                'storage',
                'color',
                'display_size',
                'condition',
                'discount'

            ]);

        });
    }
};