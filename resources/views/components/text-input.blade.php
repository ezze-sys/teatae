@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-brand-gray/30 bg-brand-gray/5 text-brand-dark focus:border-brand-red focus:ring-brand-red rounded-xl shadow-sm placeholder-gray-500 transition-all duration-200']) }}>
