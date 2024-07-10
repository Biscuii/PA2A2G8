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
        Schema::table('biens_immobiliers', function (Blueprint $table) {
            $table->string('statut')->default('En Attente');
            $table->text('message_refus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biens_immobiliers', function (Blueprint $table) {
            $table->dropColumn('statut');
            $table->dropColumn('message_refus');
        });
    }
};
