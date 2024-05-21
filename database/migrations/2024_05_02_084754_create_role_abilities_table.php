<?php

use App\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_abilities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Role::class)->constrained()->cascadeOnDelete();
            $table->string('ability');
            $table->enum('type',['allow','deny']);

            $table->unique(['role_id','ability']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_abilities');
    }
};
