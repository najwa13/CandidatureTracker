@props(['statut'])

@php
$config = [
    'to_review'           => ['label' => 'En attente',         'class' => 'bg-gray-100 text-gray-700 ring-gray-200'],
    'interview_scheduled' => ['label' => 'Entretien planifié', 'class' => 'bg-blue-100 text-blue-800 ring-blue-200'],
    'offer_received'      => ['label' => 'Offre reçue',        'class' => 'bg-green-100 text-green-800 ring-green-200'],
    'rejected'            => ['label' => 'Refusé',             'class' => 'bg-red-100 text-red-800 ring-red-200'],
    'abandoned'           => ['label' => 'Abandonné',          'class' => 'bg-yellow-100 text-yellow-700 ring-yellow-200'],
];
$item = $config[$statut] ?? ['label' => $statut, 'class' => 'bg-gray-100 text-gray-600 ring-gray-200'];
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ring-1 ring-inset {{ $item['class'] }}">
    {{ $item['label'] }}
</span>