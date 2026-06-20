@props([
    'title',
    'value',
    'icon' => null,
    'valueColor' => ''
])

<div {{ $attributes->merge(['class' => 'stat-card']) }}>
    <div class="flex items-center justify-between">
        <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">{{ $title }}</span>
        @if($icon)
            <div class="w-7 h-7 rounded bg-[#1e2d0a] flex items-center justify-center">
                <i class="fa-solid {{ $icon }} text-primary-300 text-xs"></i>
            </div>
        @endif
    </div>
    <div class="stat-card__value {{ $valueColor }}">{{ $value }}</div>
</div>
