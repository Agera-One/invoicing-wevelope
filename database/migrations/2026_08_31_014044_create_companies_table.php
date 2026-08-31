<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 320)->unique();
            $table->string('phone', 20)->unique();
            $table->string('business_entity', 255);
            $table->string('sector', 255);
            $table->string('website', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('country', 255);
            $table->string('province', 255);
            $table->string('city', 255);
            $table->string('subdistrict', 255);
            $table->text('address');
            $table->text('logo')->nullable();
            $table->text('signature')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
