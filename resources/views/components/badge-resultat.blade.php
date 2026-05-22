@props(['resultat'])

@php
$config = [
    'pending'  => ['label' => 'En attente', 'class' => 'bg-gray-100 text-gray-600 ring-gray-200'],
    'positive' => ['label' => 'Positif',    'class' => 'bg-green-100 text-green-800 ring-green-200'],
    'negative' => ['label' => 'Négatif',    'class' => 'bg-red-100 text-red-800 ring-red-200'],
];
$item = $config[$resultat] ?? ['label' => $resultat, 'class' => 'bg-gray-100 text-gray-600 ring-gray-200'];
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ring-1 ring-inset {{ $item['class'] }}">
    {{ $item['label'] }}
</span>