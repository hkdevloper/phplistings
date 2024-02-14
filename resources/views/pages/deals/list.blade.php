@php
    use App\classes\HelperFunctions;
@endphp
@extends('layouts.user')

@section('content')
    <x-user.bread-crumb :data="['Home', 'Deals', 'List']"/>
    <div class="flex flex-col justify-center items-center bg-green-50 h-[200px]">
        <h1 class="block text-lg md:text-4xl w-full text-center font-bold">Search for thousands of deals & Offers!</h1>
        <br>
        <form action="{{ route('search') }}"
              class="mt-2 md:mt-4 flex items-center justify-center md:p-4 md:pl-2 relative bg-white md:w-2/3 shadow">
            <div class="relative flex items-center justify-between md:w-full s-form">
                <label for="searchInput" class="sr-only">Search</label>
                <input id="searchInput" name="q" type="text" placeholder="Search for deals here! 🚀✨"
                       class="search-input focus:outline-none md:px-6 md:py-2 border-none outline-none focus:border-none transition-all duration-300 ease-in-out w-full placeholder:text-xs md:placeholder:text-base">
                <button type="submit"
                        class="mx-2 md:mx-0 bg-green-400 text-white md:py-2 md:px-4 w-auto md:w-[calc(100%-700px)] ml-2 hover:bg-blue-600 transition-all duration-300 ease-in-out flex items-center justify-center flex-row-reverse rounded">
                    <span class="flex items-center justify-center">
                        <span class="hidden md:block">Find Deals</span>
                        <!--search icon svg-->
                        <i class='bx bx-search-alt-2 md:hidden p-1'></i>
                    </span>
                </button>
            </div>
        </form>
    </div>
    <div class="container flex items-center justify-between my-4 md:my-8 mx-2 md:mx-auto">
        {{-- Category Filter--}}
        <div class="overflow-hidden">
            <label for="product-category-filter" class="text-gray-500 text-lg">
                <i class='bx bx-filter-alt w-5 h-5'></i>
            </label>
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
        <div class="hidden md:block">
            <p>
                Showing {{ $deals->firstItem() }} - {{ $deals->lastItem() }} of {{ $deals->total() }} results
            </p>
        </div>
        {{-- Sort By --}}
        <div class="overflow-hidden">
            <label for="product-sort-by" class="text-gray-500 text-lg">
                <i class='bx bx-filter w-5 h-5 text-lg'></i>
            </label>
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
    <div class="block w-full my-2 md:hidden">
        <p class="text-center">
            Showing {{ $deals->firstItem() }} - {{ $deals->lastItem() }} of {{ $deals->total() }} results
        </p>
    </div>
    <div class="container">
        <!-- Deals List -->
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($deals as $item)
                <div class="reveal flex bg-white rounded-lg shadow-md overflow-hidden transform transition-transform duration-300 ease-in-out hover:-translate-y-2 flex-col w-[90vw] md:w-full">
                    <a href="{{ route('view.product', [$item->slug]) }}"
                       class="w-full h-100 mx-auto p-2">
                        <img alt="deal thumbnail" src="{{ url('storage/' . $item->thumbnail) }}"
                             class="w-[150px] h-[150px] md:w-full md:h-48 object-contain"/>
                    </a>
                    <div class="p-2 flex flex-col items-center justify-center w-full">
                        <p class="text-xs text-gray-400">{{ $item->category->name }}</p>
                        <p class="text-sm font-medium mb-2 text-center h-[55px] overflow-hidden">
                            {{ strlen($item->title) > 80 ? substr($item->title, 0, 80) . '...' : $item->title }}
                        </p>
                        <p class="text-gray-700 text-center text-xs md:text-sm flex justify-center items-center">
                            <span class="text-sm text-red-500 mr-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m20.893 13.393-1.135-1.135a2.252 2.252 0 0 1-.421-.585l-1.08-2.16a.414.414 0 0 0-.663-.107.827.827 0 0 1-.812.21l-1.273-.363a.89.89 0 0 0-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 0 1-1.81 1.025 1.055 1.055 0 0 1-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 0 1-1.383-2.46l.007-.042a2.25 2.25 0 0 1 .29-.787l.09-.15a2.25 2.25 0 0 1 2.37-1.048l1.178.236a1.125 1.125 0 0 0 1.302-.795l.208-.73a1.125 1.125 0 0 0-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 0 1-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 0 1-1.458-1.137l1.411-2.353a2.25 2.25 0 0 0 .286-.76m11.928 9.869A9 9 0 0 0 8.965 3.525m11.928 9.868A9 9 0 1 1 8.965 3.525"/>
                                </svg>
                            </span>
                            {{ $item->user->company->address->country->name }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between w-full px-5">
                        <p class="text-xs text-gray-400 line-through">
                            ₹{{ HelperFunctions::formatCurrency($item->price) }}
                        </p>
                        <p class="text-lg font-bold text-gray-700">
                            ₹{{ HelperFunctions::getDiscountedPrice($item->price, $item->discount_type, $item->discount_value) }}
                        </p>
                    </div>
                    <!-- Published time -->
                    <div class="flex items-center justify-center w-full px-5">
                        <p class="text-xs text-gray-400 flex items-center justify-center">
                            <i class='bx bx-time text-lg'></i>
                            {{ $item->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-gray-700 text-center col-span-full">No listings found.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <hr class="my-5">
        {{ $deals->links() }}
    </div>
@endsection
