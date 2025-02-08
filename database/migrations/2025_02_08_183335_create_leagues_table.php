<?php

use App\Models\League;
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
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('state')->only(League::$states);
            $table->date('end_date')->nullable();
        });

        Schema::table('tournaments', function (Blueprint $table) {
            $table->foreignIdFor(League::class)->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropForeignIdFor(League::class);
        });

        Schema::dropIfExists('leagues');
    }
};
