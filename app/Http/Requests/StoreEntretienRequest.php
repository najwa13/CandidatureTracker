<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Entretien;
use Illuminate\Validation\Rule;


class StoreEntretienRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type'              => ['required', Rule::in(array_keys(Entretien::TYPES))],
            'date_heure'        => ['required', 'date'],
            'notes_preparation' => ['nullable', 'string', 'max:1000'],
            'resultat'          => ['required', Rule::in(array_keys(Entretien::RESULTATS))],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required'       => "Le type d'entretien est obligatoire.",
            'type.in'             => "Le type sélectionné est invalide.",
            'date_heure.required' => "La date et l'heure sont obligatoires.",
            'date_heure.date'     => "La date saisie est invalide.",
            'resultat.required'   => 'Le résultat est obligatoire.',
            'resultat.in'         => 'Le résultat sélectionné est invalide.',
        ];
    }
}
