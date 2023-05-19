@props(['title' => '', 'type' => 'info', 'message'])

@php
    $color = [
        'info' => 'border-blue-600 text-blue-600',
        'danger' => 'border-red-600 text-red-600',
        'success' => 'border-green-600 text-green-600',
    ][$type];
@endphp

<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 1000)" class="fixed right-0 w-full px-4 bottom-4 lg:max-w-sm" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
    <div class="border-b-3 {{ $color }} z-50 flex w-full gap-4 rounded-md border-b-4 bg-white p-4 shadow">
        <div class="flex items-center justify-center w-12 min-w-12 rounded-br-md rounded-tl-md">
            @if ($type === 'success')
                <x-icon.check class="w-6 h-6" />
            @elseif ($type === 'danger')
                <x-icon.close class="w-6 h-6" />
            @else
                <x-icon.info class="w-6 h-6" />
            @endif
        </div>
        <div class="flex flex-col items-start justify-center flex-grow">
            @if ($title)
                <p class="font-medium text-gray-900">{{ $title }}</p>
            @endif
            <p class="text-sm text-gray-700">{{ $message }}</p>
        </div>
    </div>
</div>
