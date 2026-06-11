<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();

           
            $table->foreignId('return_id')->constrained('returns')->onDelete('cascade');
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

        
            $table->decimal('refund_amount', 10, 2);
            $table->enum('refund_method', ['original_payment', 'bank_transfer', 'wallet', 'upi', 'cash'])
                  ->default('original_payment');

            $table->string('transaction_id')->nullable();           
            $table->string('bank_account_number')->nullable();      
            $table->string('bank_ifsc')->nullable();
            $table->string('upi_id')->nullable();                   

           
            $table->enum('status', ['pending', 'processing', 'completed', 'failed'])
                  ->default('pending');

            $table->text('admin_notes')->nullable();              
            $table->text('failure_reason')->nullable();             
            $table->timestamp('processed_at')->nullable();        
            $table->timestamp('completed_at')->nullable();          

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};