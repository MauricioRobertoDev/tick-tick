<button {{ $attributes->merge(['type' => 'submit', 'class' => 'h-10 px-4 gap-1 flex items-center justify-center bg-primary-500 hover:bg-primary-600 duration-300 transition text-sm font-semibold text-white rounded-md uppercase']) }}>
    {{ $slot }}
</button>
