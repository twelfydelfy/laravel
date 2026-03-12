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
    Schema::create('studenti', function (Blueprint $table) {
        $table->id();
        $table->string('nume');
        $table->string('prenume');
        $table->string('email')->unique();
        $table->string('telefon')->nullable();
        $table->string('grupa')->nullable();
        $table->integer('an_studiu')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studenti');
    }
};
