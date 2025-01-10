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
         Schema::create('compte', function (Blueprint $table) {
             $table->id('Id_compte'); // Clé primaire avec auto-incrément
             $table->string('email', 150)->nullable(false);
             $table->string('Id_utilisateur', 50)->unique()->nullable(false);
         });
     }
     


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};
