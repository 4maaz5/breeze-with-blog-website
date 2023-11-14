<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @extends('layouts.links')
    @section('links')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-1100">
                        <h2><b>{{ __('All Posts') }}</b></h2>
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                            @if (!empty($find))
                                @foreach ($find as $value)
                                    <tr>
                                        <td>{{ $value->user->name }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->description }}</td>
                                        <td>{{ $value->category }}</td>
                                        @if ($value->image)
                                            <td><img src="{{ asset($value->image) }}" style="width:150px;"></td>
                                        @endif
                                        <td><a href="{{ route('view', $value->id) }}"><button
                                                    class="btn btn-secondary">View</button></a>
                                        </td>
                                @endforeach
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endsection
