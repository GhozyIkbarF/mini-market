<x-app-layout>
    <div class="w-full mt-10 flex flex-col justify-center items-center">
        <div class="w-1/2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex justify-between items-center">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Product') }}
                    </h2>
                    <form action="{{ route('product.index') }}" method="GET" class="flex justify-end gap-2">
                        <input type="text" name="search" class="border border-gray-400 rounded-lg text-gray-600 h-10 pl-2 pr-8 w-1/2" placeholder="Search">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Search') }}
                        </button>
                    </form>
                    <a href="{{ route('product.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Create') }}
                    </a>
                </div>
                <div class="mt-4">
                    <table class="w-full text-md shadow-md rounded mb-4">
                        <tbody>
                            <tr class="border-b">
                                <th class="text-left p-3 px-5">{{ __('No') }}</th>
                                <th class="text-left p-3 px-5">{{ __('Name') }}</th>
                                <th class="text-left p-3 px-5 flex justify-end">{{ __('Action') }}</th>
                            </tr>
                            @foreach ($products as $product)
                            <tr class="border-b">
                                <td class="p-3 px-5">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="p-3 px-5">
                                    {{ $product->name }}
                                </td>
                                <td class="p-3 px-5 flex justify-end">
                                    <a href="{{ route('product.edit', $product->id) }}" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
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
                    {{-- {{ $categories->links() }} --}}
                </div>
            </div>
        </div> 
</x-app-layout>