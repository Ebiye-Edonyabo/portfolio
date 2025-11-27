<div class="w-full flex flex-col gap-1">
    <label for="{{ $model }}" class="text-sm font-medium text-white/90">
        {{ $label }}
    </label>

    <textarea 
        wire:model="{{ $model }}"  
        id="{{ $model }}" 
        rows="6" 
        placeholder="{{ $placeholder ?? '' }}"
        {{ $attributes->merge(['class' => 'w-full resize-none rounded-lg bg-gray-50 border border-secondary-100 text-sm p-2.5']) }}
    ></textarea>

    @error($model)
        <span class="text-red-400 text-xs">{{ $message }}</span>
    @enderror
</div>
