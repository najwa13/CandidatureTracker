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
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('entreprise');
            $table->string('poste');
            $table->string('url_offre')->nullable();
            $table->string('statut')->default('to_review');
            $table->string('priorite')->default('medium');
            $table->text('notes')->nullable();
            $table->date('date_candidature');
            $table->softDeletes();
            $table->timestamps();

            $table->index('user_id');
            $table->index('statut');
            $table->index('deleted_at');
            $table->index(['user_id', 'statut']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};
