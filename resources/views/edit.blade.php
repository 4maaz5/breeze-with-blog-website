<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
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
                            <h2 style="text-align: center;"><b>Edit Post</b></h2>
                        </div>
                        <form action="" method="post">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="floatingInput">Title</label>
                                <input type="text" placeholder="Title" name="title" class="form form-control"
                                    value="{{ $find->title }}">
                            </div>
                            @error('title')
                                {{ $message }}
                            @enderror
                            <div style="margin-top: 20px;">
                                <label for="floatingPassword">Description</label>
                                <input type="text" placeholder="Description" class="form form-control" name="description"
                                    value="{{ $find->description }}">
                            </div>
                            @error('description')
                                {{ $message }}
                            @enderror

                            <div style="margin-top: 20px;">
                                <label for="floatingPassword">Category</label>
                                <select class="form form-control" name="select" value="{{ $find->category }}">
                                    <option>Sports</option>
                                    <option>Politics</option>
                                    <option>Travels</option>
                                    <option>Trends</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-primary">Update Post</button>
                            </div>
                        </form>
                        <div style="margin-left: 800px;">
                            @if (session()->has('status'))
                                {{ session('status') }}
                            @endif
                        </div>
                        <div style="margin-left: 800px;">
                            @if (session()->has('status'))
                                {{ session('status') }}
                            @endif
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
