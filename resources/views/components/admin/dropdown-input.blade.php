@props([
    'label',
    'model',
    'live' => false,
])

<div class="space-y-1">
    <label 
        for="{{ $model }}" 
        class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider"
    >
        {{ $label }}
    </label>

    <select 
        @if($live) wire:model.live="{{ $model }}" @else wire:model="{{ $model }}" @endif
        id="{{ $model }}"
        {{ $attributes->merge(['class' => 'w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all']) }}
    >
        {{ $slot }}
    </select>

    @error($model)
        <span class="text-red-400 text-xs">{{ $message }}</span>
    @enderror
</div>
