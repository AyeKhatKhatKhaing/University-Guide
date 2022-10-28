@extends('master')
@section('title')
    Chat
@endsection
@section('content')

    <div class="row">
        <div class="col-12 col-md-10 ">
            <x-uni-bread-crumb>
                <li class="breadcrumb-item bg-transparent"><a href="{{ route('userPost.feedIndex') }}">Feed</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chat</li>
            </x-uni-bread-crumb>
        </div>
        <div class="col-12 col-md-4 ps-5 ann">
            @foreach($users as $user)
                @if($user->id != \Illuminate\Support\Facades\Auth::id())
                    <div class="card mb-2">
                        <div class="card-body py-2 px-4 user" id="{{$user->id}}">
                            @if($user->unread)
                            <span class="pending">{{$user->unread}}</span>
                            @endif
                            <div class="d-flex justify-content-between align-items-center ">
                                <div class="d-flex">
                                    <img src="{{ isset($user->photo) ? asset('storage/profile/'.$user->photo) : asset('images/user-default.png') }}" class="rounded-circle shadow-sm " style="width: 40px;height: 40px" alt="">
                                    <div class="d-flex flex-column ms-2">
                                        <span class=" ml-0 ml-md-2 d-none d-md-inline-block text-muted font-weight-bold">
                                        {{\Illuminate\Support\Str::words(($user->name),5)}}
                                    </span>
                                        <p class="text-muted mb-0" style="font-size: 14px">{{$user->email}}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="col-12 col-md-8 pe-3 ann" id="message">

        </div>
    </div>
@endsection
