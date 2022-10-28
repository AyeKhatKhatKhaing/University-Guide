@extends('master')
@section('title')
    All Announcements
@endsection
@section('content')

    <div class="row justify-content-center">
        <x-uni-bread-crumb>
            <li class="breadcrumb-item active" aria-current="page">All Announcement</li>
        </x-uni-bread-crumb>
        <div class="col-12 col-md-8 mt-3">
            @forelse($anns as $ann)
                <div class="card mt-3">
                    <div class="card-body">
                        <p class="h4 fw-bold" href="#">{{$ann->title}}</p>
                        <p class=" mb-0 mt-1"><i class="feather-calendar text-primary"></i>{{$ann->created_at}}</p>
                        <p style="white-space: pre-line">
                            {!! $ann->description !!}
                        </p>
                    </div>
                </div>
            @empty
                <div class="card">
                    <div class="card-body">
                        No Announcement yet!
                    </div>
                </div>
            @endforelse

        </div>
    </div>
@endsection
