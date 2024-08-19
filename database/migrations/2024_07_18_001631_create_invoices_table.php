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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('invoice_date')->nullable();
            $table->foreignId('customer_id');
            $table->foreignId('sales_rep_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('sales_rep_id')->references('id')->on('sales_reps')->onDelete('cascade');
        //    $table->foreignId('seles_reps');
            $table->string('invoice_number', 20)->unique();
            $table->double('amount', 15, 2)->nullable();
         /*   $table->double('cash', 15, 2)->nullable();
            $table->double('chq', 15, 2)->nullable();
            $table->string('chq_numbers', 100)->nullable();
            $table->date('chq_date')->nullable(); */
            $table->double('outstanding', 15, 2)->nullable();
            $table->tinyInteger('status');
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
