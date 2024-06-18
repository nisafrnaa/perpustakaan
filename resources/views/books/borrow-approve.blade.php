<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Borrow Approval') }}
        </h2>
    </x-slot>

    <div class="container mx-auto my-10">
        <div class="bg-white shadow-md dark:bg-gray-800 rounded-lg overflow-hidden">
            <h1 class="text-2xl font-semibold bg-gray-200 dark:bg-gray-700 px-6 py-4 dark:text-white text-gray-700">All Borrow Requests</h1>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800">
                    <thead class="dark:text-gray-400">
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">User</th>
                            <th class="py-3 px-6 text-left">Book</th>
                            <th class="py-3 px-6 text-left">Status</th>
                            <th class="py-3 px-6 text-left">Approved By</th>
                            <th class="py-3 px-6 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 dark:text-gray-200 text-sm font-light">
                        @foreach($bookRequests as $request)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $request->user->name }}</td>
                                <td class="py-3 px-6 text-left">{{ $request->book->title }}</td>
                                <td class="py-3 px-6 text-left">{{ ucfirst($request->status) }}</td>
                                <td class="py-3 px-6 text-left">{{ Auth::user()->name }}</td>
                                <td class="py-3 px-6 text-left">
                                    @if ($request->status == "approved")
                                    <span class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">Has Approved</span>

                                    @elseif ($request->status == "pending")
                                    <form action="{{ route('books.borrowApprove', [$request]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">Approve</button>
                                    </form>
                                    @else
                                    <form action="{{ route('books.borrowApprove', [$request]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">Approve</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
