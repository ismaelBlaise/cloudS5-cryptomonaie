<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('transaction', function (Blueprint $table) {
        $table->id('Id_transaction'); // Clé primaire avec auto-incrément
        $table->decimal('montant', 15, 2)->nullable();
        $table->timestamp('date_transaction')->nullable();
        $table->foreignId('Id_crypto')->references('Id_crypto')->on('crypto');
        $table->foreignId('Id_type_transaction')->references('Id_type_transaction')->on('type_transaction');
        $table->foreignId('Id_compte')->references('Id_compte')->on('compte');

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
