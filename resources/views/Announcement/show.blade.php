@extends('layouts.app')
@section("title")
    Announcement detail
@stop
@section("content")
    <x-bread-crumb>
        <li class="breadcrumb-item bg-transparent"><a href="{{ route('announcement.index') }}">Announcements</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{\Illuminate\Support\Str::words($announcement->title,4)}}</li>
    </x-bread-crumb>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="feather-info font-weight-bold mb-0 d-inline-block">Announcement Detail</h5>
                        <a  href="{{route('announcement.index')}}" class="btn btn-primary feather-list"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 ">
            <div class="card mt-2">
                <div class="card-body">
                    <h4 class="fw-bold">{{$announcement->title}}</h4>
                    <p>{!! $announcement->description !!}</p>
                </div>
            </div>
        </div>
    </div>

@stop
