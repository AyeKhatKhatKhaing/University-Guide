@extends('layouts.app')
@section("title")
    Sample
@stop
@section("content")
    <x-bread-crumb>
        <li class="breadcrumb-item bg-transparent"><a href="{{ route('profile') }}">Sample</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sample</li>
    </x-bread-crumb>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    Content Here
                </div>
            </div>
        </div>
    </div>

@stop
