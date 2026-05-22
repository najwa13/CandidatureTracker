<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFichierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('candidature')->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'fichiers'   => ['required', 'array', 'min:1', 'max:10'],
            'fichiers.*' => [
                'file',
                'mimes:pdf,doc,docx',
                'max:5120',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'fichiers.required'  => 'Veuillez sélectionner au moins un fichier.',
            'fichiers.max'       => 'Vous ne pouvez pas envoyer plus de 10 fichiers à la fois.',
            'fichiers.*.mimes'   => 'Chaque fichier doit être un PDF ou un document Word (.doc, .docx).',
            'fichiers.*.max'     => 'Chaque fichier ne doit pas dépasser 5 Mo.',
        ];
    }
}
