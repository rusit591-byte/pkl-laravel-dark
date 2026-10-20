@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-[#121212] border-gray-700 text-white focus:border-accentGreen focus:ring-accentGreen rounded-md shadow-sm']) }}>