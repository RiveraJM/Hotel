```blade
@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-blue-600 dark:border-blue-500 text-sm font-medium leading-5 text-blue-900 dark:text-blue-100 focus:outline-none focus:border-blue-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-blue-900 dark:hover:text-blue-200 hover:border-blue-600 dark:hover:border-blue-500 focus:outline-none focus:text-blue-900 dark:focus:text-blue-200 focus:border-blue-700 dark:focus:border-blue-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
```
