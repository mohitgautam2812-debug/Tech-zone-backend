<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->string('short_title')->nullable()->after('name');

            $table->string('sku')->nullable()->after('slug');

            $table->string('warranty')->nullable()->after('description');

            $table->text('box_contents')->nullable()->after('warranty');

            $table->longText('key_features')->nullable()->after('description');

            $table->longText('specifications')->nullable()->after('key_features');

        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn([
                'short_title',
                'sku',
                'warranty',
                'box_contents',
                'key_features',
                'specifications'
            ]);

        });
    }
};