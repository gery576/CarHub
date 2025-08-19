<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            if (!Schema::hasColumn('cars', 'km_ora')) {
                $table->integer('km_ora')->nullable()->after('ar');
            }
            if (!Schema::hasColumn('cars', 'teljesitmeny')) {
                $table->integer('teljesitmeny')->nullable()->after('km_ora');
            }
            if (!Schema::hasColumn('cars', 'valto')) {
                $table->string('valto')->nullable()->after('teljesitmeny');
            }
            if (!Schema::hasColumn('cars', 'szin')) {
                $table->string('szin')->nullable()->after('valto');
            }
            if (!Schema::hasColumn('cars', 'karosszeria')) {
                $table->string('karosszeria')->nullable()->after('szin');
            }
            if (!Schema::hasColumn('cars', 'extrak')) {
                $table->text('extrak')->nullable()->after('karosszeria');
            }
            if (!Schema::hasColumn('cars', 'uzemanyag')) {
                $table->string('uzemanyag')->nullable()->after('leiras');
            }
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn([
                'km_ora',
                'teljesitmeny',
                'valto',
                'szin',
                'karosszeria',
                'extrak',
                'uzemanyag',
            ]);
        });
    }
};
