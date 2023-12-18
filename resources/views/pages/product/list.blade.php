@extends('layouts.main-user-list')

@section('content')
    <x-user.header :title="'Products'" :breadcrumb="['Home', 'Product', 'List']" type="product"/>
    <div class="container py-6 mx-auto flex flex-wrap">
        <!-- Product List Block -->
        <div class="lg:w-3/4 w-full mb-10 lg:mb-0 overflow-hidden px-2">
            <!-- Product List Filter -->
            <div class="w-full flex flex-nowrap justify-between items-center">
                <p class="text-base text-gray-500">Search Results for <br> <span class="text-xl text-purple-500">Products</span></p>
                <p class="text-base text-gray-500">About {{count($products)}} Result</p>
            </div>
            <hr class="my-5">
            <!-- Product List -->
            @php
                $slug = null;
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($products as $item)
                    @php
                        $slug = $item->slug;
                    @endphp
                    <div class="flex flex-wrap place-items-center">
                        <div class="overflow-hidden shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-5 hover:shadow-2xl rounded-lg h-90 w-60 md:w-80 cursor-pointer m-auto">
                            <a href="{{route('view.product', [$slug])}}" class="w-full block h-full object-contain">
                                <img alt="Product photo" src="{{ url('storage/' . $item->thumbnail) }}" class="max-h-[500px] w-full object-contain"/>
                                <div class="bg-white w-full p-4">
                                    <header class="flex font-light text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 rotate-90 -ml-2"  viewBox="0 0 24 24" stroke="#b91c1c">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                        <p>{{$item->category->name}}</p>
                                    </header>
                                    <div class="flex items-center mt-2">
                                        <img class='w-10 h-10 object-cover rounded-full' alt='User avatar' src='https://ui-avatars.com/api/?name={{$item->user->name}}'/>
                                        <div class="pl-3">
                                            <div class="font-medium">
                                                {{$item->user->name}}
                                            </div>
                                            <div class="text-gray-600 text-sm">
                                                {{$item->created_at->diffForHumans()}}
                                            </div>
                                        </div>
                                        <div class="flex justify-end">
                                        </div>
                                    </div>
                                    <p class="text-indigo-500 text-sm sm:text-sm md:text-md lg:text-lg font-medium mt-2">{{ $item->name }}</p>
                                    <div class="py-4 border-t border-b text-xs text-gray-700">
                                        <div class="grid grid-cols-6 gap-1">
                                            <div class="col-span-2">
                                                @php
                                                    // Count Average Rating
                                                    $total_rating = 0;
                                                    $average_rating = 1;
                                                    try{
                                                        foreach($item->getReviews() as $item){
                                                            $total_rating += $item->rating;
                                                        }
                                                        $count = $item->getReviewsCount() ? $item->getReviewsCount() : 1;
                                                        $average_rating = $total_rating / $count;
                                                    }catch (Exception $e){
                                                        $average_rating = 1;
                                                    }
                                                @endphp
                                                Rating: {{number_format($average_rating, 1)}}
                                            </div>
                                            <div class="col-span-2">
                                                Views: {{\App\classes\HelperFunctions::getStat('view', 'product', $item->id)}}
                                            </div>
                                            <div class="col-span-2">
                                                Likes: {{\App\classes\HelperFunctions::getStat('like', 'product', $item->id)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="w-full text-center">
                        <p class="text-gray-500 text-center">No Products Found</p>
                    </div>
                @endforelse
            </div>
            <!-- Pagination -->
            <hr class="my-5">
            {{ $products->links() }}
        </div>
        <!-- Side Block -->
        @include('includes.sidebar')
    </div>
@endsection
