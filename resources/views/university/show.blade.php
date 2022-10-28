@extends('layouts.app')
@section("title")
    University Detail
@stop
@section("content")
    <x-bread-crumb>
        <li class="breadcrumb-item bg-transparent"><a href="{{ route('university.index') }}">Universities</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </x-bread-crumb>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="feather-info font-weight-bold mb-0 d-inline-block">University Detail</h5>
                        <a  href="{{route('university.index')}}" class="btn btn-primary feather-list"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-10 mt-3">
            <div class="card">
                <div class="card-body">

                    <i class="feather-layers h3 font-weight-bolder text-primary mr-2"></i><p class="d-inline-block mb-2 text-center h3 font-weight-bold">{{$university->name}}</p>
                    <img class="d-block mx-auto w-75 mt-2" src="{{asset('storage/university/'.$university->photo) }}" alt="" >
                    <i class="feather-map-pin font-weight-bolder text-warning mr-2"></i><p class="d-inline-block h5 font-weight-bold my-4 ">Location : {{$university->location}}</p>
                    <div class="mb-2"><p class="h6 font-weight-bold" class="d-inline-block mr-3"><i class="feather-check text-success mr-1"></i>{{date('Y')-1}} Entry Mark  :
                            {{$university->mark_one}}</p></div>
                    <div class="mb-4"><p class="h6 font-weight-bold" class="d-inline-block"><i class="feather-check text-success mr-1"></i>{{date('Y')-2}} Entry Mark  :
                            {{$university->mark_two}}</p></div>
                    <p style="white-space: pre-line">{{$university->description}}</p>

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
