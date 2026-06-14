@props([
    'label',
    'model',
    'file' => null,
    'existing' => null,
    'accept' => '.png,.jpg,.jpeg,.webp',
    'previewClass' => 'h-12 w-20 object-cover rounded border border-[#1f1f1f]',
])

<div class="space-y-1">
    <label for="{{ $model }}" class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider block">
        {{ $label }}
    </label>
    <input 
        type="file" 
        wire:model="{{ $model }}" 
        id="{{ $model }}"
        accept="{{ $accept }}"
        {{ $attributes->merge(['class' => 'w-full bg-[#171717] border border-[#1f1f1f] text-white px-3 py-1.5 rounded-lg text-xs outline-none focus:border-primary-300 file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[11px] file:font-semibold file:bg-[#1e2d0a] file:text-primary-300 hover:file:bg-[#1e2d0a]/80 transition-all cursor-pointer']) }}
    />
    @error($model) 
        <span class="text-red-400 text-xs block mt-1">{{ $message }}</span> 
    @enderror
</div>

@if ($file)
    <div class="mt-2 p-2 bg-[#171717] rounded-lg border border-[#1f1f1f] w-fit">
        <span class="text-[10px] text-gray-400 block mb-1">Temporary Upload:</span>
        <img src="{{ $file->temporaryUrl() }}" class="{{ $previewClass }}">
    </div>
@elseif ($existing)
    <div class="mt-2 p-2 bg-[#171717] rounded-lg border border-[#1f1f1f] w-fit">
        <span class="text-[10px] text-gray-400 block mb-1">Current File:</span>
        <img src="{{ asset($existing) }}" class="{{ $previewClass }}">
    </div>
@endif
