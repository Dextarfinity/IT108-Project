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
        Schema::create('borrowers', function (Blueprint $table) {
            $table->id('borrower_id');
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->string('gender', 50);
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('phonenumber', 50);
            $table->boolean('isborrower')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowers');
    }
};
