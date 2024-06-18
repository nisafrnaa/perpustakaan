<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bookmarks') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">Bookmarked Books</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($books as $book)
                <a href="{{ route('books.show', $book->id) }}">
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-auto">
                        <img class="rounded-t-lg" src="{{ asset('storage/' . $book->book_cover) }}" alt="Book Image" />
                        <div class="p-5">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $book->title }}</h5>
                            <h6 class="mb-2 text-lg tracking-tight text-gray-900 dark:text-white">{{ $book->author }}</h6>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
