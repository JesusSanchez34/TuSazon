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
        Schema::table('promotions', function (Blueprint $table) {
            $table->boolean('activo')->default(true)->after('fecha_fin');
        });
    }
    
    public function down()
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->dropColumn('activo');
        });
    }
};