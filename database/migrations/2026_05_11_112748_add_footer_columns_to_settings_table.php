<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {

            $table->string('site_name')->nullable();

            $table->text('footer_description')->nullable();

            $table->string('facebook')->nullable();

            $table->string('twitter')->nullable();

            $table->string('instagram')->nullable();

            $table->string('youtube')->nullable();

            $table->string('address')->nullable();

            $table->string('phone')->nullable();

            $table->string('email')->nullable();

            $table->string('copyright')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {

            $table->dropColumn([
                'site_name',
                'footer_description',
                'facebook',
                'twitter',
                'instagram',
                'youtube',
                'address',
                'phone',
                'email',
                'copyright'
            ]);

        });
    }
};