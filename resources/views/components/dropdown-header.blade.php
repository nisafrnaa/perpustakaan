<div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out">
    <button id="dropdownHoverButton" @click="open = !open" type="button">
        {{$trigger}}
    </button>

    <!-- Dropdown menu -->
    <div x-show="open" @click.away="open = false" id="dropdownHover" class="absolute left-0 top-full mt-2 z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700" x-cloak>
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
            {{ $content }}

        </ul>
    </div>
</div>
