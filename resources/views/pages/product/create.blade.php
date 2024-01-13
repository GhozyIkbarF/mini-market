<x-app-layout>
    <div class="w-full mt-10 pb-10 flex flex-col justify-center items-center">
        <div class="w-1/2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"
                class="w-full flex flex-col gap-3 items-start p-6 text-gray-900 dark:text-gray-100">
                @csrf
                <h1>Tambah Product</h1>
                <div class="w-full">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input type="text" name="name" id="name" :value="old('name')" class="block mt-1 w-full" placeholder="Product" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mb-4 w-full">
                    <x-input-label for="price" :value="__('Price')" />
                    <x-text-input type="text" name="price" id="price" :value="old('price')" class="block mt-1 w-full" placeholder="Price" required />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
                <div class="mb-4 w-full">
                    <x-input-label for="quantity" :value="__('Quantity')" />
                    <x-text-input type="text" name="quantity" id="quantity" :value="old('quantity')" class="block mt-1 w-full" placeholder="Quantity" required />
                    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                </div>
                <div class="mb-4 w-full">
                    <x-input-label for="description" :value="__('Descrpition')" />
                    <textarea type="text" name="description" id="description" class="w-full border border-gray-400 rounded-lg text-gray-600 h-36 pl-2 pr-8 " placeholder="Description" required>{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class="mb-4 w-full">
                    <x-input-label for="image" :value="__('Image')" />
                    <x-text-input type="file" name="image" id="image" class="block mt-1 w-full" placeholder="Image" required />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
                <div class="mb-4 w-full">
                    <x-input-label for="image" :value="__('Image')" />
                    <x-text-input type="text" name="discount" id="discount" :value="old('discount')" class="block mt-1 w-full" placeholder="Discount" />
                    <x-input-error :messages="$errors->get('discount')" class="mt-2" />
                </div>
                <div class="rounded-lg shadow w-72 max-h-96 mb-3">
                    <div class="p-3">
                        <label for="input-group-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input id="search-category" type="search" id="input-group-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search category">
                        </div>
                    </div>
                    <ul id="list-category"
                        class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200">
                        @foreach ($categories as $category)
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input id="checkbox-item-{{ $category->id }}-category" type="checkbox"
                                        value="{{ $category->id }}" name="category[]"
                                        @if (in_array($category->id, old('category', []))) checked @endif
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="checkbox-item-{{ $category->id }}-category"
                                        class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{ $category->name }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-full flex justify-end mt-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Create') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
                const searchCategory = document.getElementById('search-category');

                searchCategory.addEventListener('keyup', function() {
                    const value = this.value.toLowerCase();
                    const listFree = document.querySelectorAll('#list-category li');

                    listFree.forEach((item) => {
                        const text = item.textContent.toLowerCase();

                        if (text.indexOf(value) != -1) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
    
            });
</script>
