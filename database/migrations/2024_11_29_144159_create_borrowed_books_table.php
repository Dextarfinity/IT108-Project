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
        Schema::create('borrowed_books', function (Blueprint $table) {
            $table->id(); // Default primary key
            $table->foreignId('borrower_id')
                  ->constrained('borrowers', 'borrower_id') // Reference 'borrower_id'
                  ->onDelete('cascade'); // Handle cascading deletes
            $table->foreignId('copy_id')
                  ->constrained('copies', 'copy_id') // Reference 'copy_id'
                  ->onDelete('cascade');
            $table->foreignId('librarian_id')
                  ->constrained('librarians', 'librarian_id') // Reference 'librarian_id'
                  ->onDelete('cascade');
            $table->date('date_borrowed');
            $table->date('return_date');
            $table->date('date_returned')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowed_books');
    }
};
