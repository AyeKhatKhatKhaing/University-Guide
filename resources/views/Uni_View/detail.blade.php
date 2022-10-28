@extends('master')
@section('title')
    Home
@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 ">
            <x-uni-bread-crumb>
                <li class="breadcrumb-item active" aria-current="page">{{$university->name}}</li>
            </x-uni-bread-crumb>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="feather-info font-weight-bold mb-0 d-inline-block">University Detail</h5>
                        <a  href="{{route('uniView.index')}}" class="btn btn-primary feather-list fs-6"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-10 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="justify-content-center d-flex mb-2"><i class="feather-layers h3 font-weight-bolder text-primary mr-2"></i><p class="d-inline-block mb-2 text-center h3 font-weight-bold">{{$university->name}}</p></div>
                    <img class="d-block mx-auto w-50 mt-2" src="{{asset('storage/university/'.$university->photo) }}" alt="" >
                    <hr class="mb-0">
                    <i class="feather-map-pin font-weight-bolder text-warning mr-2"></i><p class="d-inline-block h5 font-weight-bold my-4 ">Location : {{$university->location}}</p>
                    <div class="mb-2"><p class="h6 fw-bold" class="d-inline-block mr-3"><i class="feather-check text-success mr-1"></i>{{date('Y')-1}} Entry Mark  :
                            {{$university->mark_one}}</p></div>
                    <div class="mb-4"><p class="h6 fw-bold" class="d-inline-block"><i class="feather-check text-success mr-1"></i>{{date('Y')-2}} Entry Mark  :
                            {{$university->mark_two}}</p></div>
                    <p style="white-space: pre-line">{{$university->description}}</p>
                </div>
            </div>

        </div>
    </div>
@endsection
