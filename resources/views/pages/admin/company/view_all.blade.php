@extends('main')

@section("content")
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Companies
                    </h2>
                    <div class="flex ml-auto">
                        <a href="{{route('add.company')}}"
                           class="ml-auto note-btn flex text-theme-1 dark:text-theme-10 mx-1">
                            Add New Company
                        </a>
                    </div>
                </div>
                {{-- Main Content goes Here --}}
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full">
                        <thead>
                        <tr>
                            <th class="border-b-2 whitespace-no-wrap">#ID</th>
                            <th class="border-b-2 whitespace-no-wrap">Name</th>
                            <th class="border-b-2 whitespace-no-wrap">Phone</th>
                            <th class="border-b-2 whitespace-no-wrap">Email</th>
                            <th class="border-b-2 whitespace-no-wrap">Approved</th>
                            <th class="border-b-2 whitespace-no-wrap">Claimed</th>
                            <th class="text-center whitespace-no-wrap">ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $data)
                            <tr>
                                <td class="border-b">{{$data->id}}</td>
                                <td class="border-b">{{$data->name}}</td>
                                <td class="border-b">{{$data->phone}}</td>
                                <td class="border-b">{{$data->email}}</td>
                                <td class="border-b">
                                    <div class="mt-2">
                                        <input type="checkbox" @if($data->approved) checked
                                               @endif data-id="{{$data->id}}" class="input input--switch border">
                                    </div>
                                </td>
                                <td class="border-b">
                                    <div class="mt-2">
                                        <input type="checkbox" @if($data->claimed) checked
                                               @endif data-id="{{$data->id}}" class="input input--switch border">
                                    </div>
                                </td>
                                <td class="table-report__action w-56">
                                    <div class="flex justify-center items-center">
                                        <a class="flex items-center mr-3" href="{{route('edit.company', [$data->id])}}">
                                            <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                        <a class="flex items-center text-theme-6"
                                           onclick="confirm('Are you sure?') ? window.location.replace('{{url('/')}}') : ''"
                                           href="javascript:"> <i data-feather="trash-2" class="w-4 h-4 mr-1"
                                                                  onclick=""></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection

@section('page-scripts')
    {{-- Scripts for this page goes here --}}

@endsection