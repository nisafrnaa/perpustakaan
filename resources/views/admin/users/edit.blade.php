<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="container mx-auto my-10 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-200">Edit User</h2>

        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-200">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 dark:text-gray-200">Email address</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 dark:text-gray-200">Password</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label for="roles" class="block text-gray-700 dark:text-gray-200">Roles</label>
                <select id="roles" name="roles[]" required class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:text-gray-200">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ in_array($role->name, $user->roles->pluck('name')->toArray()) ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Update</button>
        </form>
    </div>
</x-app-layout>
