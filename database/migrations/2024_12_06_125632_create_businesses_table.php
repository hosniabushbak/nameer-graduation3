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
        Schema::create('businesses', function (Blueprint $table) {
            $table->foreignId('owner_id')->constrained('owners')->onDelete('cascade');
            $table->string('business_name');
            $table->string('commercial_registration');
            $table->text('pre_disaster_address');
            $table->string('business_type');
            $table->decimal('land_area', 10, 2);
            $table->decimal('building_area', 10, 2);
            $table->integer('employees_count');
            $table->integer('building_age')->nullable();
            $table->enum('damage_level', ['partial', 'total']);
            $table->text('equipment_losses');
            $table->text('inventory_losses');
            $table->json('damage_photos')->nullable();
            $table->decimal('estimated_cost', 12, 2)->nullable();
            $table->string('ownership_document')->nullable();
            $table->string('licenses')->nullable();
            $table->string('inspection_report')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
