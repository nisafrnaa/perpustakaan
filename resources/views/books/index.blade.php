
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book Chill Perpus') }}
        </h2>
    </x-slot>
    <div class="container mx-auto my-10">
        <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Books</h1>
            @if (session('success'))
                <div class="bg-green-500 text-gray-800 dark:text-white px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <a href="{{ route('books.create') }}" class="bg-blue-500 text-gray-800 dark:text-white px-4 py-2 rounded">Add New Book</a>
            <table class="table-auto w-full mt-4">
                <thead class="bg-gray-200 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-gray-800 dark:text-white">Title</th>
                        <th class="px-4 py-2 text-gray-800 dark:text-white">Author</th>
                        <th class="px-4 py-2 text-gray-800 dark:text-white">Status</th>
                        <th class="px-4 py-2 text-gray-800 dark:text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr class="border-b dark:border-gray-700">
                        <td class=" px-4 py-2 text-gray-800 dark:text-white">{{ $book->title }}</td>
                        <td class=" px-4 py-2 text-gray-800 dark:text-white">{{ $book->author }}</td>
                        <td class=" px-4 py-2 text-gray-800 dark:text-white">{{ $book->status }}</td>
                        <td class=" px-4 py-2">
                            <a href="{{ route('books.edit', $book->id) }}" class="bg-yellow-500 text-gray-800 dark:text-white px-4 py-2 rounded">Edit</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-gray-800 dark:text-white px-4 py-2 rounded">Delete</button>
                            </form>
                            @if ($book->status == 'pending')
                            <form action="{{ route('publish.approve', [$book]) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-green-500 text-gray-800 dark:text-white px-4 py-2 rounded">Approve</button>
                            </form>
                            <form action="{{ route('publish.disapprove', [$book]) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-red-500 text-gray-800 dark:text-white px-4 py-2 rounded">Disapprove</button>
                            </form>

                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
