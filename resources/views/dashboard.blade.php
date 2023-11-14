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
                                @can('isAdmin')
                                    <th>Name</th>
                                @endcan
                                <th>Post Title</th>
                                <th>Post Description</th>
                                <th>Category</th>
                                <th>Image</th>
                                @can('isAdmin')
                                    <th>Actions</th>
                                @endcan
                            </tr>
                            @foreach ($data as $key)
                                <tr>
                                    @can('isAdmin')
                                        <td>{{ $key->user->name }}</td>
                                    @endcan
                                    <td>{{ $key->title }}</td>
                                    <td>{{ $key->description }}</td>
                                    <td>{{ $key->category }}</td>
                                    @if ($key->image)
                                        <td>
                                            <div class="image-zoom-container">
                                                <img src="{{ asset($key->image) }}" alt="Zoomable Image" id="zoomable-image"
                                                    style="width: 150px;">
                                            </div>
                                        </td>
                                    @endif
                                    <td style="width:300px;">
                                        <a href="{{ route('view', $key->id) }}"><button
                                                class="btn btn-secondary">View</button></a>
                                        @can('isAdmin')
                                            <a href="{{ route('edit', $key->id) }}"><button
                                                    class="btn btn-primary">Edit</button></a>&nbsp<a
                                                href="{{ route('delete', $key->id) }}"><button
                                                    class="btn btn-danger">Delete</button></a>
                                            <a href="{{ route('users') }}"><button class="btn btn-secondary">Users</button></a>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </table>
                        <h4>{{ $data->links() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#zoomable-image").on("click", function() {
            $(this).toggleClass("zoomed");
        });
    });
</script>




