<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Book') }}
        </h2>
    </x-slot>
    <div class="container mx-auto my-10">
        <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Create Book</h1>
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-800 dark:text-white">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                        class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-800 dark:text-white">
                    <x-input-error :messages="$errors->get('title')" class="mt-2 text-sm text-red-400" />
                </div>
                <div class="mb-4">
                    <label for="book_cover" class="block text-sm font-medium text-gray-800 dark:text-white">Book Cover</label>
                    <input type="file" id="book_cover" name="book_cover"
                        class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-800 dark:text-white">
                    <x-input-error :messages="$errors->get('book_cover')" class="mt-2 text-sm text-red-400" />
                </div>
                <div class="mb-4">
                    <label for="author" class="block text-sm font-medium text-gray-800 dark:text-white">Author</label>
                    <input type="text" id="author" name="author" value="{{ old('author') }}" required
                        class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-800 dark:text-white">
                    <x-input-error :messages="$errors->get('author')" class="mt-2 text-sm text-red-400" />
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-800 dark:text-white">Category</label>
                    <select id="category_id" name="category_id"
                            class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-800 dark:text-white">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2 text-sm text-red-400" />
                </div>
                <div class="mb-4">
                    <label for="penerbit" class="block text-sm font-medium text-gray-800 dark:text-white">Penerbit</label>
                    <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit') }}" required
                        class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-800 dark:text-white">
                    <x-input-error :messages="$errors->get('penerbit')" class="mt-2 text-sm text-red-400" />
                </div>
                <div class="mb-4">
                    <label for="shelf" class="block text-sm font-medium text-gray-800 dark:text-white">Shelf</label>
                    <input type="text" id="shelf" name="shelf" value="{{ old('shelf') }}" required
                        class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-800 dark:text-white">
                    <x-input-error :messages="$errors->get('shelf')" class="mt-2 text-sm text-red-400" />
                </div>
                <div class="mb-4">
                    <label for="row" class="block text-sm font-medium text-gray-800 dark:text-white">Row</label>
                    <input type="number" id="row" name="row" value="{{ old('row') }}" required
                        class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-800 dark:text-white">
                    <x-input-error :messages="$errors->get('row')" class="mt-2 text-sm text-red-400" />
                </div>
                <div class="mb-4">
                    <label for="stok" class="block text-sm font-medium text-gray-800 dark:text-white">Stok</label>
                    <input type="number" id="stok" name="stok" value="{{ old('stok') }}" required
                        class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-800 dark:text-white">
                    <x-input-error :messages="$errors->get('stok')" class="mt-2 text-sm text-red-400" />
                </div>
                <div class="mb-4">
                    <label for="book_files" class="block text-sm font-medium text-gray-800 dark:text-white">Book Files</label>
                    <input type="file" id="book_files" name="book_files"
                        class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 border-gray-600 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-800 dark:text-white">
                    <x-input-error :messages="$errors->get('book_files')" class="mt-2 text-sm text-red-400" />
                </div>
                <div class="mt-6">
                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-gray-800 dark:text-white rounded-md hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Create
                        Book</button>
                </div>
            </form>
        </div>
    </div>
@</x-app-layout>
