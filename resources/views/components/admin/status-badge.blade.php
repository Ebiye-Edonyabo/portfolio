@props([
    'status',
])

@php
    $statusValue = $status instanceof \App\Enums\Status ? $status->value : $status;
    $isPublished = $statusValue === 'published';
@endphp

<span class="px-2 py-0.5 rounded text-[10px] font-semibold {{ $isPublished ? 'bg-[#1e2d0a] text-primary-300 border border-primary-500/20' : 'bg-gray-800 text-gray-400' }}">
    {{ ucfirst($statusValue) }}
</span>
