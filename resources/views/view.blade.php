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
                        <h2><b>{{ __('Post Data') }}</b></h2>
                        <hr>
                        <figure class="figure">
                            @if (!empty($post))
                                {{-- <h4 class="card-title">{{ $post->title }}</h4> --}}
                                <figcaption class="figure-caption">
                                    <p class="card-text">{{ $post->description }}</p>
                                </figcaption>
                                @if ($post->image)
                                    <img src="{{ asset($post->image) }}" style="width:1200px; ">
                                @endif
                        </figure>
                       <form method="get" action="{{ route('like', $post->id) }}" id="myform">
                            <button class="btn btn-secondary" id="disableButton"><i
                                    class="fas fa-thumbs-up" ></i></button></form>

                        <form action="{{ route('comment', $post->id) }}" method="post" id="my-form">
                            @csrf
                            <input type="text" class="form form-control" name="comment"
                                style="width:250px;margin-left:130px;margin-top:-35px;" placeholder="Comments">
                            <a href="" style="margin-left: 390px;"><button class="btn btn-secondary"
                                    style="margin-top: -65px;" id="myButton">Comments</button></a>
                            <a href="{{ route('viewcomment', $post->id) }}" style="margin-left:-320px;">View Comments
                                >>></a>
                            <div style="margin-left:110px;">
                                @error('comment')
                                    {{ $message }}
                                @enderror
                                @if (session()->has('message'))
                                    {{ session('message') }}
                                @endif
                            </div>
                        </form>
                        <span id="output" style="margin-left: 120px;"></span>
                    </div>
                    @endif
                    @if (!empty($counted))
                        <h5 style="margin-left: 40px;margin-top:-40px;">{{ $counted }}</h5>
                    @endif
                </div>
            </div>
        </div>
    </x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var button1 = document.getElementById('Button1');
        button1.addEventListener('click', function() {
            button1.style.backgroundColor = 'blue';
            button1.disabled = true;
        });
    </script>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
         $(document).ready(function(){
     $('#my-form').submit(function(event){
        event.preventDefault();
        var form=$('#my-form')[0];
        var data=new FormData(form);
        $('myButton').prop('disabled',true);
        $.ajax({
            type:"post",
            url:"{{ route('comment',$post->id) }}",
            data:data,
            processData:false,
            contentType:false,
            success:function(data){
                $('#output').text(data.contact);
        $('#myButton').prop('disabled',false);
            },
            error:function(e){
                $('#output').text(e.responseText);
        $('#myButton').prop('disabled',false);
            }
        });
     });
     });


     $(document).ready(function(){
     $('#myform').submit(function(event){
        event.preventDefault();
        var form=$('#myform')[0];
        var data=new FormData(form);
        $('disableButton').prop('disabled',true);
        $.ajax({
            type:"get",
            url:"{{ route('like',$post->id) }}",
            data:data,
            processData:false,
            contentType:false,
            success:function(data){
                // $('#output').text(data.contact);
        $('#disableButton').prop('disabled',false);
            },
            error:function(e){
                // $('#output').text(e.responseText);
        $('#disableButton').prop('disabled',false);
            }
        });
     });
     });
     </script>
