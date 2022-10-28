@extends('layouts.app')
@section("title")
    Sample
@stop
@section("content")
    <x-bread-crumb>
        <li class="breadcrumb-item bg-transparent"><a href="{{ route('userManager.index') }}">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$user->name}}</li>
    </x-bread-crumb>

    <div class="row justify-content-center">
        <div class="col-1"></div>
        <div class="col-12 col-md-4 mt-3">
            <div class="card">
                <div class="card-body">
                    <h4>{{$user->name}}'s Profile</h4>
                    <hr>
                    <div class="d-flex justify-content-center mb-2">
                        <img style="width: 200px;height: 200px" class="rounded-circle d-block" src="{{ $user->photo? asset('storage/profile/'.\Illuminate\Support\Facades\Auth::user()->photo) : asset('images/user-default.png')}}" alt="">
                    </div>
                    <div class="d-flex justify-content-center">
                        <p class="h5 text-muted text-center fw-bold d-inline px-3">{{$user->name}}</p>
                    </div>
                    <hr>
                    <div class="ps-5 mb-4"><i class="feather-mail text-success ml-3"></i><p class="h6 text-muted ms-3 d-inline-block">{{$user->email}}</p></div>
                    <div class="ps-5 mb-4"><i class="feather-phone text-primary ml-3"></i><p class="h6 text-muted ms-3 d-inline-block">{{$user->phone}}</p></div>
                    <div class="ps-5 mb-4"><i class="feather-map-pin text-warning ml-3"></i><p class="h6 text-muted ms-3 d-inline-block">{{$user->address}}</p></div>

                </div>
            </div>

        </div>
        <div class="ann col-12 border-start border-2 col-md-7 mt-3">
            <div class="card">
                <div class="card-body">

                </div>
            </div>

        </div>
    </div>

@stop
