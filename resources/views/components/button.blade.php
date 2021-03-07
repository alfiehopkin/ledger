<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-6 py-2 font-bold italic border-4 border-gray-400 border-t-white border-l-white bg-gradient-to-l from-gray-500 to-gray-300 focus:outline-none']) }}>
    {{ $slot }}
</button>
