@props([
    'title',
])

<div {{ $attributes->merge(['class' => 'table-container']) }}>
    <div class="px-6 py-4 border-b border-[#1f1f1f] flex items-center justify-between">
        <h3 class="text-xs font-bold text-white tracking-wide uppercase">{{ $title }}</h3>
        @isset($actions)
            <div>{{ $actions }}</div>
        @endisset
    </div>
    <div class="overflow-x-auto">
        <table class="table">
            {{ $slot }}
        </table>
    </div>
</div>
