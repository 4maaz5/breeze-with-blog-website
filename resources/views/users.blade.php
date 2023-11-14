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
                        <h2><b>{{ __('Online Users') }}</b></h2>
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td style="color:rgb(32, 216, 32);">Active</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endsection
