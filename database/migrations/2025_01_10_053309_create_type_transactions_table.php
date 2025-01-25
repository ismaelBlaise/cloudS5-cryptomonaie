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
    Schema::create('type_transaction', function (Blueprint $table) {
        $table->id('Id_type_transaction'); // Clé primaire avec auto-incrément
        $table->string('nom', 150)->nullable(false);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_transaction');
    }
};
