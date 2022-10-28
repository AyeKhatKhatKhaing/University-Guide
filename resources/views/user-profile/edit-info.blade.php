@extends('layouts.app')
@section("title")
    Edit Profile
@stop
@section("content")
    <x-bread-crumb>
        <li class="breadcrumb-item bg-transparent"><a href="{{ route('profile') }}">Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Info</li>
    </x-bread-crumb>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.changeInfo') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="" class="feather-user"> Current Name</label>
                            <input type="text" required class="form-control" name="current_name" disabled value="{{ \Illuminate\Support\Facades\Auth::user()->name  }}">
                        </div>
                        <div class="form-group">
                            <label for="" class="feather-refresh-ccw"> Change Name</label>
                            <input type="text" required class="form-control" name="new_name" placeholder="New Name">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="" class="feather-mail"> Current Email</label>
                            <input type="text" required class="form-control" name="current_email" disabled value="{{ \Illuminate\Support\Facades\Auth::user()->email }}">
                        </div>
                        <div class="form-group">
                            <label for="" class="feather-refresh-ccw"> Change Email</label>
                            <input type="text" required class="form-control" name="new_email" placeholder="New Email">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="" class="feather-mail"> Current Phone Number</label>
                            <input type="phone" required class="form-control" name="current_phone" disabled value="{{ \Illuminate\Support\Facades\Auth::user()->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="" class="feather-refresh-ccw"> Change Phone Number</label>
                            <input type="number" required class="form-control" name="new_phone" placeholder="New Phone Number">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="" class="feather-mail"> Current Address</label>
                            <textarea type="text" required class="form-control" name="current_address" disabled>{{ \Illuminate\Support\Facades\Auth::user()->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="feather-refresh-ccw"> Change Address</label>
                            <textarea type="text" required class="form-control" name="new_address" placeholder="New Address"></textarea>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-5 mt-3">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="sure2" name="sure2" required>
                                    <label class="custom-control-label text-muted" for="sure2">
                                        I'm sure
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary feather-refresh-ccw" type="submit"> Change Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
