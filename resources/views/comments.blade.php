@extends('layouts.links')
@section('links')
    <br>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-1100">
                    <h2><b>{{ __('Comments Section..... ') }}</b></h2>
                </div>
            </div>
        </div>
    </div>
    @if (!empty($store))
        @foreach ($store as $key)
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        @php
                            $new = $key->user_id;
                        @endphp
                        @foreach ($user as $users)
                            @php
                                $neww = $users->id;
                                if ($new == $neww) {
                                    echo '<h5>' . $users->name . '</h5>';
                                }
                            @endphp
                        @endforeach
                    </div>
                    <div class="modal-body">
                        <h5 style="margin-left:20px;">{{ $key->comment }}</h5>

                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('trash', $key->user_id) }}" method="get" id="myform">
                            <a href="{{ route('trash', $key->user_id) }}"><button class="btn btn-danger"
                                    id="delete">Delete</button></a>
                        </form>
                        @if (session()->has('message'))
                            {
                            {{ $message }}
                            }
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    @if (session()->has('message'))
        {{ session('message') }}
    @endif
@endsection
