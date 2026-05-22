<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Candidature;
use Illuminate\Validation\Rule;

class StoreCandidatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'entreprise'       => ['required', 'string', 'max:255'],
            'poste'            => ['required', 'string', 'max:255'],
            'url_offre'        => ['nullable', 'url', 'max:500'],
            'statut'           => ['required', Rule::in(array_keys(Candidature::STATUTS))],
            'priorite'         => ['required', Rule::in(array_keys(Candidature::PRIORITES))],
            'notes'            => ['nullable', 'string'],
            'date_candidature' => ['required', 'date'],
        ];
    }
    public function messages(): array
    {
        return [
            'entreprise.required'       => "Le nom de l'entreprise est obligatoire.",
            'poste.required'            => 'Le poste visé est obligatoire.',
            'url_offre.url'             => "L'URL doit être une adresse web valide.",
            'statut.required'           => 'Le statut est obligatoire.',
            'statut.in'                 => 'Le statut sélectionné est invalide.',
            'priorite.required'         => 'La priorité est obligatoire.',
            'priorite.in'               => 'La priorité sélectionnée est invalide.',
            'date_candidature.required' => 'La date de candidature est obligatoire.',
            'date_candidature.date'     => 'La date saisie est invalide.',
        ];
    }
}
