@extends('layouts.app')
@section("title")
    Edit University
@stop
@section("content")
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Edit University</li>
    </x-bread-crumb>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="feather-upload font-weight-bold mb-0 d-inline-block">Edit University</h5>
                        <button type="submit" form="universityForm" class="btn btn-primary feather-upload"></button>
                    </div>
                    <form action="{{route('university.update',$university->id)}}" method="post" id="universityForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="mt-2 mb-2 ml-2 text-center pr-3 pt-4">
                        <img id="previewImg" class="img-thumbnail rounded" src="{{ asset('storage/university/'.$university->photo) }}" style="width:300px;height:200px">
                    </div>
                    <div class="form-group ">

{{--                            <img id="previewImg" onclick="$('#photo').trigger('click');" class="w-100 d-none rounded"--}}
{{--                                 src="" alt="your image" />--}}
                            <label for="photo">
                        <i class="mr-1 feather-image"></i>
                        University Photo
                        </label>
                        <input form="universityForm" type="file" id="photo" onchange="previewFile(this);" name="photo"
                               class="form-control p-1 mr-2 overflow-hidden @error('photo') is-invalid @enderror">
                        @error('photo')
                        <small class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>
                    <div class="form-group mt-2 mb-0" >
                        <i class="mr-1 feather-layers"></i>
                        <label>University Name</label>
                        <input type="text" name="name" form="universityForm" value="{{ old('name',$university->name) }}" class="form-control @error('name') is-invalid @enderror">

                        @error('name')
                        <small class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group mt-2 mb-0" >
                        <i class="mr-1 feather-map-pin"></i>
                        <label>Location</label>
                        <input type="text" name="location" form="universityForm" value="{{ old('location',$university->location) }}" class="form-control @error('location') is-invalid @enderror">
                        @error('location')
                        <small class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-inline mt-2 mb-0" >
                        <div class="w-50">
                            <i class="mr-1 feather-check-circle"></i>
                            <label class="d-inline">Entry Mark(Year One)</label>
                            <input type="number" name="markOne" form="universityForm" value="{{ old('markOne',$university->mark_one) }}" class="form-control @error('markOne') is-invalid @enderror">
                            @error('markOne')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <div class="w-50">
                            <i class="mr-1 feather-check-circle"></i>
                            <label class="d-inline">Entry Mark(Year Two)</label>
                            <input type="number" name="markTwo" form="universityForm" value="{{ old('markTwo',$university->mark_two) }}" class="form-control @error('markTwo') is-invalid @enderror">
                            @error('markTwo')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mt-2 mb-0">
                        <i class="mr-1 feather-info"></i>
                        <label>Description</label>
                        <textarea style="white-space: pre-line" name="description" form="universityForm" rows="10" class="description form-control @error('description') is-invalid @enderror">
                                {{ old('description',$university->description) }}
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
    <script>
        function previewFile(input) {
            let file = $("input[type=file]").get(0).files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function() {
                    $("#previewImg").attr("src", reader.result);
                    $("#previewImg").removeClass("d-none");
                    $("#cover").hide();
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
