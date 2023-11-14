<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>
    @extends('layouts.links')
    @section('links')
        <br>
        <div class="container">
            <div class="row justify-content-center align-items-center inner-row">
                <div class="col-md-5">
                    <div class="form-box p-5" style="border: solid 1px gray;">
                        <div class="form-title">
                            <h2 style="text-align: center;"><b>Post Details</b></h2>
                        </div>
                        <form action="{{ route('insert') }}" method="post" style="margin-left: 0px;margin-top:20px;"
                            enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="floatingInput">Title</label>
                                <input type="text" placeholder="Title" name="title" class="form form-control">
                            </div>
                            @error('title')
                                {{ $message }}
                            @enderror
                            <div style="margin-top: 20px;">
                                <label for="floatingPassword">Description</label>
                                <textarea row="3" class="form form-control" placeholder="Description" name="description">
                    </textarea>
                            </div>
                            @error('description')
                                {{ $message }}
                            @enderror
                            <div style="margin-top: 20px;">
                                <label for="floatingPassword">Category</label>
                                <select class="form form-control" name="select">
                                    <option>Sports</option>
                                    <option>Politics</option>
                                    <option>Travels</option>
                                    <option>Trends</option>
                                </select>
                            </div>
                            <div>
                                <label for="floatingInput" style="margin-top: 20px;">Image</label>
                                <input type="file" placeholder="Image" name="image" class="form form-control">
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-primary">Add Post</button>
                            </div>
                        </form>
                        <div style="margin-top:10px;">
                            @if (session()->has('status'))
                                {{ session('status') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
