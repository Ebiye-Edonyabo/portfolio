<div class="w-full flex flex-col gap-1">
    <label for="{{ $model }}" class="text-sm font-medium text-white/90">
        {{ $label }}
    </label>

    <input 
        wire:model="{{ $model }}" 
        type="{{ $type ?? 'text' }}" 
        id="{{ $model }}" 
        placeholder="{{ $placeholder ?? '' }}"
        {{ $attributes->merge(['class' => 'bg-gray-50 border border-secondary-100 text-sm rounded-lg p-2.5 w-full']) }}
    />

    @error($model)
        <span class="text-red-400 text-xs">{{ $message }}</span>
    @enderror
</div>
