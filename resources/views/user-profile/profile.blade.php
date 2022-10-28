@extends('layouts.app')
@section("title")
     Profile
@stop
@section("content")
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </x-bread-crumb>
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow-sm mt-1 py-3">
                <div class="card-body">
                    <h3 class="text-center">Profile</h3>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-md-4 d-flex align-items-center">
                             <img src="{{ isset(Illuminate\Support\Facades\Auth::user()->photo)? asset('storage/profile/'.\Illuminate\Support\Facades\Auth::user()->photo) : asset('images/user-default.png') }}" alt="avatar" class="mx-auto rounded-circle d-inline-block" style="width: 200px;height: 200px">
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Full Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{\Illuminate\Support\Facades\Auth::user()->email}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Phone</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{\Illuminate\Support\Facades\Auth::user()->phone}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{\Illuminate\Support\Facades\Auth::user()->address}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
