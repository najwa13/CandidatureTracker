<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Entretien extends Model
{
     use HasFactory;

    protected $fillable = [
        'candidature_id',
        'type',
        'date_heure',
        'notes_preparation',
        'resultat',
    ];

    protected $casts = [
        'date_heure' => 'datetime',
    ];

     public const TYPES = [
        'phone'     => 'Téléphone',
        'technical' => 'Technique',
        'hr'        => 'RH',
        'final'     => 'Final',
    ];

    public const RESULTATS = [
        'pending'  => 'En attente',
        'positive' => 'Positif',
        'negative' => 'Négatif',
    ];

     public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    public function getResultatLabelAttribute(): string
    {
        return self::RESULTATS[$this->resultat] ?? $this->resultat;
    }


    public function candidature(): BelongsTo
    {
        return $this->belongsTo(Candidature::class);
    }
}
