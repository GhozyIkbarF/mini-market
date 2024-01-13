{{-- @extends('layouts.app') --}}
<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot> --}}
    {{-- @section('content') --}}
    <div class="w-full mt-10 flex flex-col justify-center items-center">
        <div class="w-1/2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex justify-between items-center">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Category') }}
                    </h2>
                    <form action="{{ route('category.index') }}" method="GET" class="flex justify-end gap-2">
                        <input type="text" name="search" class="border border-gray-400 rounded-lg text-gray-600 h-10 pl-2 pr-8 w-1/2" placeholder="Search">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Search') }}
                        </button>
                    </form>
                    {{-- <a href="{{ route('category.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Create') }}
                    </a> --}}
                </div>
                <div class="mt-4">
                    <table class="w-full text-md shadow-md rounded mb-4">
                        <tbody>
                            <tr class="border-b">
                                <th class="text-left p-3 px-5">{{ __('Name') }}</th>
                                {{-- <th class="text-left p-3 px-5">{{ __('Slug') }}</th> --}}
                                <th class="text-left p-3 px-5 flex justify-end">{{ __('Action') }}</th>
                            </tr>
                            @foreach ($categories as $category)
                            <tr class="border-b">
                                <td class="p-3 px-5">
                                    {{ $category->name }}
                                </td>
                                <td class="p-3 px-5 flex justify-end">
                                    <a href="{{ route('category.edit', $category->id) }}" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $categories->onEachSide(2)->links() }} --}}
                    {{ $categories->links() }}
                </div>
            </div>
        </div>    

        <div class="mt-10 w-1/2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{ route('category.store') }}" method="POST" class="p-6">
                @csrf
                <h1>Add new category</h1>
                <div class="flex justify-between items-center">
                    <input type="text" name="name" id="name" class="border border-gray-400 rounded-lg text-gray-600 h-10 pl-2 pr-8 w-full" placeholder="Category">
                </div>
                <div class="flex justify-start mt-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Create') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- @endsection --}}
</x-app-layout>