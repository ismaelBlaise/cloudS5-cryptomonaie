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
    Schema::create('taux', function (Blueprint $table) {
        $table->id('Id_taux'); // Clé primaire avec auto-incrément
        $table->decimal('prix', 18, 2)->nullable();
        $table->date('date_taux')->nullable(false);
        $table->foreignId('Id_crypto')->references('Id_crypto')->on('crypto');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tauxes');
    }
};
