<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->char('customer_code', 14)->unique('customer_code');
            $table->string('name', 255);
            $table->string('email', 320)->unique('email');
            $table->string('phone', 20)->unique('phone');
            $table->text('address');
            $table->foreignId('company_id')->constrained('companies')->restrictOnDelete()->restrictOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
