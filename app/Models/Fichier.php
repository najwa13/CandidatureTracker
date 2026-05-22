<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Fichier extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidature_id',
        'nom_original',
        'chemin',
        'type_mime',
        'taille',
    ];

     public function getTailleListibleAttribute(): string
    {
        $octets = $this->taille ?? 0;
        if ($octets < 1024) return $octets . ' o';
        if ($octets < 1048576) return round($octets / 1024, 1) . ' Ko';
        return round($octets / 1048576, 1) . ' Mo';
    }
    public function candidature(): BelongsTo
    {
        return $this->belongsTo(Candidature::class);
    }
}
