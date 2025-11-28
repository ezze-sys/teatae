@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-stone-600 dark:bg-stone-900/50 dark:text-gray-100 focus:border-brand-red dark:focus:border-brand-red focus:ring-brand-red dark:focus:ring-brand-red rounded-xl shadow-sm placeholder-gray-400 dark:placeholder-stone-500 transition-all duration-200']) }}>
