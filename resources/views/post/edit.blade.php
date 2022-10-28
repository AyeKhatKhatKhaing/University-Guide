@extends('layouts.app')
@section("title")
    Edit Post
@stop
@section('head')
    <link rel="stylesheet" href="{{asset('vendor/summer_note/summernote.css')}}">
@endsection
@section("content")
    <x-bread-crumb>
        <li class="breadcrumb-item bg-transparent"><a href="{{ route('post.index') }}">Posts</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
    </x-bread-crumb>

    <div class="row justify-content-center" style="z-index: 2001">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <img src="{{ isset(Auth::user()->photo) ? asset('storage/profile/'.Auth::user()->photo) : asset('images/user-default.png') }}" class="rounded-circle shadow-sm " style="width: 50px;height: 50px" alt="">
                            <span class="ml-0 ml-md-2 d-none d-md-inline-block text-muted font-weight-bold">
                        {{\Illuminate\Support\Facades\Auth::user()->name}}
                    </span>
                        </div>
                        <div>
                            <button type="submit" form="postForm" class="btn btn-primary feather-upload"></button>
                            <form action="{{route('post.update',$post->id)}}" method="post" id="postForm" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mt-2 mb-0" >
                        <textarea type="text" name="description" form="postForm" class="smn form-control mt-2 @error('description') is-invalid @enderror">
                            {{$post->description}}
                        </textarea>
                        @error('description')
                        <small class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('foot')
    <script src="{{asset('vendor/summer_note/summernote.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.smn').summernote({
                height: 300
            });
        });
    </script>
@endsection
