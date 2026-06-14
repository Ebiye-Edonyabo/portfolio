@props([
    'label',
    'model',
    'rows' => 4,
])

<div class="space-y-1.5">
    <label for="{{ $model }}" class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">
        {{ $label }}
    </label>

    <textarea 
        wire:model="{{ $model }}"  
        id="{{ $model }}" 
        rows="{{ $rows }}"
        {{ $attributes->merge(['class' => 'w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-2 rounded-lg text-xs outline-none focus:border-primary-300 transition-all resize-none']) }}
    ></textarea>

    @error($model)
        <span class="text-red-400 text-xs">{{ $message }}</span>
    @enderror
</div>
