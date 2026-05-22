@props(['priorite'])

@php
$config = [
    'high'   => ['label' => 'Haute',   'class' => 'bg-red-100 text-red-800 ring-red-200'],
    'medium' => ['label' => 'Moyenne', 'class' => 'bg-orange-100 text-orange-700 ring-orange-200'],
    'low'    => ['label' => 'Faible',  'class' => 'bg-gray-100 text-gray-600 ring-gray-200'],
];
$item = $config[$priorite] ?? ['label' => $priorite, 'class' => 'bg-gray-100 text-gray-600 ring-gray-200'];
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ring-1 ring-inset {{ $item['class'] }}">
    {{ $item['label'] }}
</span>