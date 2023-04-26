@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="bg-red-100 text-black font-bold border-l-4 border-red-600">{{ $message }}</li>
        @endforeach
    </ul>
@endif
