<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Ajout des nouvelles colonnes
            $table->string('statut')->default('En Attente')->after('date_fin');
            $table->decimal('prix_total', 10, 2)->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {

            $table->dropColumn('statut');
            $table->dropColumn('prix_total');
        });
    }
};
