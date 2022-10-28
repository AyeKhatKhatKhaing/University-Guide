@extends('master')
@section('title')
    Sample
@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 ">
            <x-uni-bread-crumb>
                <li class="breadcrumb-item bg-transparent"><a href="{{ route('university.index') }}">Sample</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sample</li>
            </x-uni-bread-crumb>
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-12 col-md-10 mt-3">
            <div class="card">
                <div class="card-body">
                    Here
                </div>
            </div>

        </div>
    </div>
@endsection
