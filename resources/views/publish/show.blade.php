<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Book') }}
        </h2>
    </x-slot>

    <div class="container px-4 py-8">
        <div class="max-w-4xl mx-auto flex bg-white rounded-lg shadow dark:bg-gray-800 flex-col md:flex-row">
            <div class="relative w-full md:w-48 flex justify-center items-center">
                <img src="{{ asset('storage/' . $book->book_cover) }}" alt="Book Cover"
                    class="object-cover w-full h-48 md:h-full rounded-t-lg md:rounded-l-lg md:rounded-t-none">
            </div>
            <form id="borrowForm" action="{{ route('books.borrowRequest', [$book]) }}" method="POST" class="flex-auto p-6">
                @csrf
                <div class="flex flex-wrap">
                    <h1 class="flex-auto text-xl font-semibold dark:text-gray-50">{{ $book->title }}</h1>
                    <div class="text-xl font-semibold text-blue-500 dark:text-blue-300">{{ $book->category->name }}</div>
                    <div class="flex-none w-full mt-2 text-sm font-medium text-gray-500 dark:text-gray-300">{{ $book->penerbit }}</div>
                    <div class="flex-none w-full mt-2 text-sm font-medium text-gray-500 dark:text-gray-300">{{ $book->shelf }} - {{ $book->row }}</div>
                </div>
                <div class="flex items-baseline mt-4 mb-6 text-gray-700 dark:text-gray-300">
                    <p class="hidden ml-auto text-sm text-gray-500 md:block dark:text-gray-300">{{ $book->stok }} pcs</p>
                </div>
                @auth
                @php
                    $request = $book->request->where('user_id', Auth::id())->first()// Assuming $book->borrowRequest represents the associated borrow request
                @endphp
                @if (empty($request))
                <div class="flex mb-4 text-sm font-medium gap-4">
                    <button type="submit"
                        class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg ">Pinjam</button>
                </div>
                @elseif ($request->status == 'pending')
                    <div class="flex mb-4 text-sm font-medium gap-4">
                        <span
                            class="py-2 px-4 bg-gray-600 hover:bg-gray-700 focus:ring-gray-500 focus:ring-offset-gray-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg ">Waiting the Aprroval</span>
                    </div>
                @else
                <a href="{{ asset('storage/' . $book->book_files) }}" class="text-blue-400">Baca</a></p>
                @endif
                @else
                <div class="flex mb-4 text-sm font-medium gap-4">
                    <button type="submit"
                        class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg ">Pinjam</button>
                </div>
                @endauth
            </form>
        </div>
    </div>
</x-app-layout>
