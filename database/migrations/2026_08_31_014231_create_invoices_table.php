<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->char('invoice_code', 13)->unique('invoice_code');
            $table->date('date');
            $table->date('due_date');
            $table->foreignId('company_id')->constrained('companies')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('customer_id')->constrained('customers')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
