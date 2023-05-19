@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-200 focus:border-primary-500 focus:ring-primary-500 rounded-md shadow-sm min-h-10',
]) !!}></textarea>
