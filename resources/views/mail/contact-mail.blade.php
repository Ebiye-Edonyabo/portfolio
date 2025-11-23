<x-mail::message>
# Hello I am {{ $form['name'] ?? '' }}

{{ $form['message'] }}

<x-mail::panel>
My email: {{ $form['email'] }}
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
