<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            // user_id nullable karo — guest users ke liye
            $table->unsignedBigInteger('user_id')->nullable()->change();

            // product_id nullable karo — general inquiry ke liye  
            $table->unsignedBigInteger('product_id')->nullable()->change();

            // email nullable karo
            $table->string('email')->nullable()->change();

            // extra fields add karo
            $table->string('phone')->nullable()->after('email');
            $table->string('city')->nullable()->after('phone');
            $table->string('purpose')->nullable()->after('city');
            $table->string('budget')->nullable()->after('purpose');
        });
    }

    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->unsignedBigInteger('product_id')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->dropColumn(['phone', 'city', 'purpose', 'budget']);
        });
    }
};