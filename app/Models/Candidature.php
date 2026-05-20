<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
class Candidature extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'entreprise',
        'poste',
        'url_offre',
        'statut',
        'priorite',
        'notes',
        'date_candidature',
    ];

    protected $casts = [
        'date_candidature' => 'date',
    ];

     public const STATUTS = [
        'to_review'           => 'En attente',
        'interview_scheduled' => 'Entretien planifié',
        'offer_received'      => 'Offre reçue',
        'rejected'            => 'Refusé',
        'abandoned'           => 'Abandonné',
    ];

    public const PRIORITES = [
        'high'   => 'Haute',
        'medium' => 'Moyenne',
        'low'    => 'Faible',
    ];

     public function getStatutLabelAttribute(): string
    {
        return self::STATUTS[$this->statut] ?? $this->statut;
    }

    public function getPrioriteLabelAttribute(): string
    {
        return self::PRIORITES[$this->priorite] ?? $this->priorite;
    }

     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function entretiens(): HasMany
    {
        return $this->hasMany(Entretien::class)->orderBy('date_heure');
    }

    public function fichiers(): HasMany
    {
        return $this->hasMany(Fichier::class);
    }

}
