@extends('layouts.app')
@section("title")
    Add University
@stop
@section("content")
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Add University</li>
    </x-bread-crumb>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="feather-plus-circle font-weight-bold mb-0 d-inline-block">Add University</h5>
                        <button type="submit" form="universityForm" class="btn btn-primary feather-plus-circle"></button>
                    </div>
                    <form action="{{route('university.store')}}" method="post" id="universityForm" enctype="multipart/form-data">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="form-group ">
                        <a id="edit" onclick="$('#photo').trigger('click');"
                           class="btn d-none text-white btn-warning btn-sm" style="position:absolute; right: 22px;">
                            <i class="feather-edit"></i>
                        </a>
                        <img id="previewImg" onclick="$('#photo').trigger('click');" class="w-100 d-none rounded"
                             src="" alt="your image" />
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
                        <input type="text" name="name" form="universityForm" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <small class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="form-group mt-2 mb-0" >
                        <i class="mr-1 feather-map-pin"></i>
                        <label>Location</label>
                        <input type="text" name="location" form="universityForm" value="{{ old('location') }}" class="form-control @error('location') is-invalid @enderror">
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
                            <input type="number" name="markOne" form="universityForm" value="{{ old('markOne') }}" class="form-control @error('markOne') is-invalid @enderror">
                            @error('markOne')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="w-50">
                            <i class="mr-1 feather-check-circle"></i>
                            <label class="d-inline">Entry Mark(Year Two)</label>
                            <input type="number" name="markTwo" form="universityForm" value="{{ old('markTwo') }}" class="form-control @error('markTwo') is-invalid @enderror">
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
                        <textarea name="description" form="universityForm" rows="10" class="description form-control @error('description') is-invalid @enderror">
                                {{ old('description') }}
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
                    $("#edit").removeClass("d-none");

                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
