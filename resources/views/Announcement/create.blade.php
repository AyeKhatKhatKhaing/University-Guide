@extends('layouts.app')
@section("title")
    Announce
@stop
@section('head')
    <link rel="stylesheet" href="{{asset('vendor/summer_note/summernote.css')}}">
@endsection
@section("content")
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Announce</li>
    </x-bread-crumb>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('announcement.store')}}" method="post" id="storeForm" enctype="multipart/form-data">
                        @csrf
                    </form>
                    <div><button type="submit" form="storeForm" class="btn btn-primary feather-plus-circle float-right"></button></div>
                    <div class="form-group mt-2 mb-0" >
                        <i class="mr-1 feather-alert-circle"></i>
                        <label>Title</label>
                        <input type="text" name="title" form="storeForm" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror">
                    </div>
                    @error('name')
                    <span class="text-danger"></span>
                    @enderror
                    <div class="form-group mt-2 mb-0" >
                        <i class="mr-1 feather-map-pin"></i>
                        <label>Location</label>
                        <textarea name="description" form="storeForm" class="smn form-control @error('description') is-invalid @enderror"></textarea>
                    </div>
                    @error('description')
                    <span class="text-danger"></span>
                    @enderror
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
