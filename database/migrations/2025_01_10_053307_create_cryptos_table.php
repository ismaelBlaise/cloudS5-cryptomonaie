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
    Schema::create('crypto', function (Blueprint $table) {
        $table->id('Id_crypto'); // Clé primaire avec auto-incrément
        $table->string('nom', 50)->nullable(false);
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto');
    }
};
