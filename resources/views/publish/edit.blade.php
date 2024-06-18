<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Book') }}
        </h2>
    </x-slot>
    <div class="max-w-xl container mx-auto my-10">
        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg p-6">
            <h1 class="text-2xl font-bold text-white mb-4">Edit Book - {{ $book->title }}</h1>
            <form action="{{ route('publish.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-white">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required
                        class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-white">
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="book_cover" class="block text-sm font-medium text-white">Book Cover</label>
                    <input type="file" id="book_cover" name="book_cover"
                        class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-white">
                    @if ($book->book_cover)
                        <p class="text-gray-400 mt-2">Current Cover:</p>
                        <img src="{{ asset('storage/' . $book->book_cover) }}" alt="Book Cover" class="mt-1" style="max-width: 200px;">
                    @endif
                    <x-input-error :messages="$errors->get('book_cover')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="author" class="block text-sm font-medium text-white">Author</label>
                    <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required
                        class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-white">
                    <x-input-error :messages="$errors->get('author')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-white">Category</label>
                    <select id="category_id" name="category_id"
                            class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-white">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="penerbit" class="block text-sm font-medium text-white">Penerbit</label>
                    <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit', $book->penerbit) }}" required
                        class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-white">
                    <x-input-error :messages="$errors->get('penerbit')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="shelf" class="block text-sm font-medium text-white">Shelf</label>
                    <input type="text" id="shelf" name="shelf" value="{{ old('shelf', $book->shelf) }}" required
                        class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-white">
                    <x-input-error :messages="$errors->get('shelf')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="row" class="block text-sm font-medium text-white">Row</label>
                    <input type="number" id="row" name="row" value="{{ old('row', $book->row) }}" required
                        class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-white">
                    <x-input-error :messages="$errors->get('row')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="stok" class="block text-sm font-medium text-white">Stok</label>
                    <input type="number" id="stok" name="stok" value="{{ old('stok', $book->stok) }}" required
                        class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-white">
                    <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="book_files" class="block text-sm font-medium text-white">Book Files</label>
                    <input type="file" id="book_files" name="book_files"
                        class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-white">
                    @if ($book->book_files)
                        <p class="text-gray-400 mt-2">Current Book Files: <a href="{{ asset('storage/' . $book->book_files) }}" target="_blank" class="text-blue-400">Download</a></p>
                    @endif
                    <x-input-error :messages="$errors->get('book_files')" class="mt-2" />
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Update Book</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
