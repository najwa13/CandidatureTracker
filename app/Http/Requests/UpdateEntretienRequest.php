<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Entretien;
use Illuminate\Validation\Rule;


class UpdateEntretienRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('entretien')->candidature->user_id === auth()->id();
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
        return (new StoreEntretienRequest())->messages();
    }
}
