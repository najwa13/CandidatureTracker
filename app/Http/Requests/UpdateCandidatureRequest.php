<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Candidature;
use Illuminate\Validation\Rule;

class UpdateCandidatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
         return $this->route('candidature')->user_id === auth()->id();
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
        return (new StoreCandidatureRequest())->messages();
    }
}
