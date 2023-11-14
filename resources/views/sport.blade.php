<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sports') }}
        </h2>
    </x-slot>
    @extends('layouts.links')
    @section('links')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-1100">
                        <h2><b>{{ __('Post Data') }}</b></h2>
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>Post Title</th>
                                <th>Post Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($post as $posts)
                                @php
                                    $category = $posts->category;
                                @endphp
                                @if ($category === 'Sports')
                                    {
                                    <tr>
                                        <td>{{ $posts->user->name }}</td>
                                        <td>{{ $posts->title }}</td>
                                        <td>{{ $posts->description }}</td>
                                        @if ($posts->image)
                                            <td><img src="{{ asset($posts->image) }}" style="width: 150px;"></td>
                                        @endif
                                        <td><a href="{{ route('view', $posts->id) }}"><button
                                                    class="btn btn-secondary">View</button></a></td>
                                    </tr>
                                    }
                                @endif
                            @endforeach
                        </table>

                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                                        {{ __("You're logged in!") }}
                                    </div>
                                </div>
                            </div>
                        </div>
    </x-app-layout>
@endsection
