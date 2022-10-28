@extends('master')
@section('title')
    Post Feed
@endsection
@section('content')

    <div class="row justify-content-center">
        <x-uni-bread-crumb>
            <li class="breadcrumb-item active" aria-current="page">Post Feed</li>
        </x-uni-bread-crumb>
        <div class="col-12 mb-3 ps-5 pe-3">
            <div class="card">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between">
                        <div>
                            @isset(request()->search)
                                <a class="btn btn-secondary feather-list mr-3 fs-6" href="{{ route('userPost.feedIndex') }}">All Posts </a>
                            @endisset
                        </div>
                        <form action="{{ route('userPost.feedIndex') }}" method="get">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control " name="search" placeholder="Search Post">
                                <button class="btn btn-primary fs-6 feather-search ms-2" type="submit"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="ann col-12 border-start border-2 col-md-8 mb-5 ps-5">

            @forelse($posts as $post)
                <div class="card mb-3">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <img src="{{ \App\User::find($post->user_id)->photo ? asset('storage/profile/'.\App\User::find($post->user_id)->photo) : asset('images/user-default.png') }}" class="rounded-circle shadow-sm " style="width: 50px;height: 50px" alt="">
                                <div class="d-flex flex-column ms-2">
                                    <span class="ml-0 ml-md-2 d-none d-md-inline-block text-muted font-weight-bold">
                        {{$post->owner}}
                                </span>
                                    <span class="feather-clock text-primary ml-1 mt-1"><p class="d-inline ml-1">{{$post->created_at->diffForHumans()}}</p></span>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-3 ">
                        <p>{!! $post->description !!}</p>
                        <hr class="mt-1 mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            @if(\App\Comment::where('post_id',$post->id)->count()>0)
                                <h5 class="text-success">{{\App\Comment::where('post_id',$post->id)->count()}} Comments</h5>
                            @else
                                <h5 class="text-success">No Comment Yet !</h5>
                            @endif

                            <a href="{{route('userPost.feedDetail',$post->id)}}" class="btn btn-success rounded-pill text-center">Detail</a>
                        </div>
                        <hr class="mt-2 mb-0">
                    </div>
                </div>
            @empty
                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="text-center">No post yet !</h5>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="col-12 col-md-4 pe-3 ann border-start">
            <div class="card mb-3">
                <div class="card-body py-2 px-4">
                    <p class="text-muted fw-bold mb-1">You</p>
                    <hr class="my-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{route('uniView.profile')}}">
                                <img src="{{ isset(Auth::user()->photo) ? asset('storage/profile/'.Auth::user()->photo) : asset('images/user-default.png') }}" class="rounded-circle shadow-sm " style="width: 40px;height: 40px" alt="">
                            </a>
                            <span class=" ml-0 ml-md-2 d-none d-md-inline-block text-muted font-weight-bold">
                        {{\Illuminate\Support\Str::words((\Illuminate\Support\Facades\Auth::user()->name),5)}}
                    </span>
                        </div>
                        <div>
                            <a href="{{route('uniView.profile')}}" class="btn btn-sm btn-primary fs-6 feather-plus-circle"></a>
                            <a href="{{route('chat.index')}}" class="btn btn-sm btn-success fs-6 feather-message-square"></a>
                        </div>
                    </div>
                </div>
            </div>
            @foreach(\App\User::orderBy('name','desc')->get() as $user)
                @if($user->id != \Illuminate\Support\Facades\Auth::id())
                    <div class="card mb-2">
                        <div class="card-body py-2 px-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{route('userPost.userProfile',$user->id)}}">
                                        <img src="{{ isset($user->photo) ? asset('storage/profile/'.$user->photo) : asset('images/user-default.png') }}" class="rounded-circle shadow-sm " style="width: 40px;height: 40px" alt="">
                                    </a>
                                    <span class=" ml-0 ml-md-2 d-none d-md-inline-block text-muted font-weight-bold">
                                        {{\Illuminate\Support\Str::words(($user->name),5)}}
                                    </span>
                                </div>
                                <div>
                                    <a href="{{route('chat.index')}}" class="btn btn-sm btn-success fs-6 feather-message-square"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
@endsection
