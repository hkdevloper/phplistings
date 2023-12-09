@php use App\classes\HelperFunctions; @endphp
@extends('layouts.main-user-list')

@section('content')
    <x-user.header :title="'Forums'" :breadcrumb="['Home', 'Forum', 'List']" type="forum"/>
    <div class="container py-6 mx-auto flex flex-wrap">
        <!-- Forum List BLock -->
        <div class="lg:w-3/4 w-full mb-10 lg:mb-0 overflow-hidden px-2">
            <div class="card card-hovered p-4 mb-2">
                <div class="container mx-auto">
                    <ul class="flex justify-center space-x-4">
                        <li>
                            <a href="{{route('forum')}}"
                               class="px-4 py-2 text-gray-600 border border-1 rounded-full border-solid @if($tab == null)border-purple-500 @else border-transparent @endif hover:border-purple-500 transition duration-300 ease-in-out">Recent
                                Questions</a>
                        </li>
                        <li>
                            <a href="{{route('forum', ['tab' => 'most_answered'])}}"
                               class="px-4 py-2 text-gray-600 border border-1 rounded-full border-solid @if($tab == 'most_answered')border-purple-500 @else border-transparent @endif hover:border-purple-500 transition duration-300 ease-in-out">Most
                                Answered</a>
                        </li>
                        <li>
                            <a href="{{route('forum', ['tab' => 'un_answered'])}}"
                               class="px-4 py-2 text-gray-600 border border-1 rounded-full border-solid @if($tab == 'un_answered')border-purple-500 @else border-transparent @endif hover:border-purple-500 transition duration-300 ease-in-out">Unanswered</a>
                        </li>
                        <li>
                            <a href="{{route('forum', ['tab' => 'featured'])}}"
                               class="px-4 py-2 text-gray-600 border border-1 rounded-full border-solid @if($tab == 'featured')border-purple-500 @else border-transparent @endif hover:border-purple-500 transition duration-300 ease-in-out">Featured</a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-2 ">
                <!-- Forum list Item -->
                @forelse($forums as $forum)
                    <div class="bg-white card p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <img src="https://via.placeholder.com/100x100" alt="User Avatar"
                                     class="w-10 h-10 rounded-full mr-4">
                                <div>
                                    <h2 class="text-base font-semibold text-gray-800">{{$forum->user->name}}</h2>
                                    <p class="text-gray-500 text-sm">Posted
                                        on {{date_format($forum->created_at, 'd M y')}}</p>
                                </div>
                            </div>
                            <div>
                                <span class="text-gray-600 text-sm">Category: {{$forum->category->name}}</span>
                            </div>
                        </div>
                        <h1 class="text-lg font-semibold text-gray-900 mb-4">{{$forum->title}}</h1>
                        <p class="text-gray-700 text-sm"></p>
                        <hr class="my-4 border-t-2 border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-600 text-sm">{{$forum->countAnswers()}} Answers</span>
                                <span class="ml-4 text-gray-600 text-sm">{{HelperFunctions::getStat('view', 'forum', $forum->id)}} Views</span>
                            </div>
                            <div>
                                <button
                                    onclick="window.location.href = '{{route('view.forum', [$forum->id, \Illuminate\Support\Str::slug($forum->title)])}}'"
                                    class="text-white bg-purple-500 hover:bg-purple-600 font-bold uppercase text-xs px-4 py-2 rounded-full focus:outline-none">
                                    Answer
                                </button>
                                <button class="text-purple-500 hover:underline ml-2">
                                    <i class='bx bx-share-alt'></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white card p-6">
                        <h1 class="text-lg font-semibold text-gray-900 mb-4 text-center">No Forum Found</h1>
                    </div>
                @endforelse
            </div>
            <!-- Pagination -->
            {{$forums->links()}}
        </div>
        <!-- Side Block -->
        @include('includes.sidebar')
    </div>
@endsection
