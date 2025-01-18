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
        Schema::create('houses', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->foreignId('owner_id')->constrained('owners')->onDelete('cascade');
                $table->enum('ownership_type', ['owned', 'rented']);
                $table->decimal('land_area', 10, 2);
                $table->decimal('building_area', 10, 2);
                $table->integer('floors_count');
                $table->integer('rooms_count');
                $table->integer('building_age')->nullable();
                $table->enum('damage_level', ['partial', 'total']);
                $table->text('damage_description');
                $table->text('damage_photos')->nullable();
                $table->decimal('estimated_cost', 12, 2)->nullable();
                $table->string('ownership_document')->nullable();
                $table->string('inspection_report')->nullable();
                $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
