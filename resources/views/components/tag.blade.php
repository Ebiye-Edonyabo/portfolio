@props(['route' => null])

@if ($route)
    <a 
        href="{{ $route }}" 
        target="_blank"
        class="inline-block text-xs text-nowrap font-medium px-2.5 py-1 rounded-full bg-gray-900/70 text-primary-300/90 border border-primary-500/20"
    >
       <strong>{{  $slot  }}</strong>
    </a>
@else
    <span class="inline-block text-xs text-nowrap font-medium px-2.5 py-1 rounded-full bg-gray-900/70 text-primary-300/90 border border-primary-500/20">
        <strong>{{  $slot  }}</strong>
    </span>
@endif
