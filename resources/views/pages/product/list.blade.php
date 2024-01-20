@extends('layouts.user')

@section('content')
    <div class="flex flex-col justify-center items-center bg-green-50 h-[200px]">
        <h1 class="block text-4xl w-full text-center font-bold">Search for thousands of products</h1>
        <br>
        <form action="{{ route('search') }}"
              class="mt-2 md:mt-4 flex items-center justify-center p-4 pl-2 relative bg-white w-2/3 shadow">
            <div class="relative flex items-center justify-between w-full s-form">
                <label for="searchInput" class="sr-only">Search</label>
                <input id="searchInput" name="q" type="text" placeholder="Type at least 3 characters"
                       class="search-input focus:outline-none px-6 py-2 border-none outline-none focus:border-none transition-all duration-300 ease-in-out w-full">
                <button type="submit"
                        class="bg-green-400 text-white py-2 px-4 w-[calc(100%-700px)] ml-2 hover:bg-blue-600 transition-all duration-300 ease-in-out flex items-center justify-center flex-row-reverse rounded">
                    <span class="inline">Find Product</span>
                </button>
            </div>
            <div id="searchResults" class="search-results mt-2"></div>
        </form>
    </div>
    <div class="container flex items-center justify-between my-8">
        {{-- Category Filter--}}
        <div class="">
            <label for="product-category-filter" class="text-gray-500">Filter by Category</label>
            <select name="category" id="product-category-filter"
                    class="border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-500 w-[150px]"
                    onchange="doFilter()">
                <option value="all" selected>All</option>
                @foreach($categories as $category)
                    @if(request()->get('category') == $category->name)
                        <option selected value="{{ $category->name }}">{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        {{-- Total Products --}}
        <div class="">
            <p>
                Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} results
            </p>
        </div>
        {{-- Sort By --}}
        <div class="">
            <label for="product-sort-by" class="text-gray-500">Sort By</label>
            <select name="sort" id="product-sort-by"
                    class="border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm text-gray-500 w-[150px]"
                    onchange="doSort()">
                <option value="" @if(!request()->get('sort')) selected @endif>Select sorting</option>
                <option value="name" @if(request()->get('sort') == 'name') selected @endif>Name</option>
                <option value="price-low-to-high" @if(request()->get('sort') == 'price-low-to-high') selected @endif>
                    Price low to high
                </option>
                <option value="price-high-to-low" @if(request()->get('sort') == 'price-high-to-low') selected @endif>
                    Price high to low
                </option>
            </select>
        </div>
    </div>
    <script>
        function doSort() {
            let sortValue = document.getElementById('product-sort-by').value;
            let categoryValue = document.getElementById('product-category-filter').value;
            applyFilters(categoryValue, sortValue);
        }

        function doFilter() {
            let categoryValue = document.getElementById('product-category-filter').value;
            let sortValue = document.getElementById('product-sort-by').value;
            applyFilters(categoryValue, sortValue);
        }

        function applyFilters(category, sort) {
            let url = '{{ route('products') }}';
            let params = [];

            if (category !== 'all') {
                params.push('category=' + category);
            }

            if (sort !== 'default') {
                params.push('sort=' + sort);
            }

            if (params.length > 0) {
                url += '?' + params.join('&');
            }

            window.location.href = url;
        }
    </script>
    <div class="container">
        <!-- Product List -->
        @forelse($products as $key => $item)
            <div
                class="card p-4 my-4 mx-3 shadow border border-b border-solid border-gray-100 flex items-center justify-between">
                <div class="w-full flex items-center justify-center">
                    <div class="overflow-hidden mb-4 p-2" style="border-right: 1px solid lightgray">
                        <img class="w-full h-40 object-contain overflow-hidden"
                             src="{{ url('storage/' . $item->thumbnail) }}" width="250"
                             alt="">
                    </div>
                    <div class="flex items-start justify-start flex-col w-full ml-6">
                        <span class="text-base text-gray-500 -mb-1">{{$item->category->name}}</span>
                        <a href="{{ route('view.product', [$item->slug]) }}"
                           class="font-semibold text-2xl">{{ $item->name }}</a>
                        <span class="text-base text-gray-500 -mb-1">Condition: {{$item->condition}}</span>
                        <span class="text-base text-gray-500 -mb-1">Brand: {{$item->brand}}</span>
                        <span
                            class="bg-white rounded-full text-orange-500 text-base font-bold px-3 py-2 leading-none flex items-center">₹ {{$item->price}}</span>
                    </div>
                </div>
                <!-- Product List Action -->
                <div class="text-center w-[calc(20%-1rem)] text-base">
                    <a href="{{ route('view.product', [$item->slug]) }}"
                       class="text-white bg-green-400 hover:bg-purple-500 hover:text-white rounded-full px-3 py-2 transition duration-300 ease-in-out flex items-center transform hover:-translate-y-1 hover:scale-110 justify-center text-center flex-nowrap flex-auto">
                    <span class="mr-1 text-center">
                        Enquire Now
                    </span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-3 h-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25"/>
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="w-full text-center">
                <p class="text-gray-500 text-center">No Products Found</p>
            </div>
        @endforelse

        <!-- Pagination -->
        <hr class="my-5">
        {{ $products->links() }}
    </div>
@endsection
