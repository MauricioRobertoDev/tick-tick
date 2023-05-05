<button {{ $attributes->merge(['type' => 'submit', 'class' => 'h-10 px-4 flex items-center justify-center bg-red-500 hover:bg-red-600 duration-300 transition text-sm font-semibold text-white rounded-lg']) }}>
    {{ $slot }}
</button>
