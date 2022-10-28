@extends('layouts.app')
@section("title")
    Post Detail
@stop
@section("content")
    <x-bread-crumb>
        <li class="breadcrumb-item bg-transparent"><a href="{{ route('post.index') }}">Post  </a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$post->owner}}</li>
    </x-bread-crumb>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <img src="{{ \App\User::find($post->user_id)->photo ? asset('storage/profile/'.\App\User::find($post->user_id)->photo) : asset('images/user-default.png') }}" class="rounded-circle shadow-sm " style="width: 50px;height: 50px" alt="">
                                <div class="d-flex flex-column ml-2">
                                    <span class="ml-0 ml-md-2 d-none d-md-inline-block text-muted font-weight-bold">
                        {{$post->owner}}
                                </span>
                                    <span class="feather-clock text-muted ml-1 mt-1"><p class="d-inline ml-1">{{$post->created_at->diffForHumans()}}</p></span>
                                </div>
                            </div>
                            <div>
                                <a href="{{route('post.index')}}" class="btn btn-primary feather-list"></a>
                            </div>
                        </div>
                        <hr>
                        <p>{!! $post->description !!}</p>
                        <hr>
                        <div class="d-flex align-items-center justify-content-between">
                            @if(\App\Comment::where('post_id',$post->id)->count() > 0)
                                <p class="h4 font-weight-bold text-success d-inline">{{\App\Comment::where('post_id',$post->id)->count()}} Comments</p>
                            @else
                                <p class="h4 font-weight-bold d-inline text-center">No Comment Yet !</p>
                            @endif

                            <input type="hidden" name="post_id" value="{{$post->id}}" form="commentForm">
                            <input type="hidden" name="owner_id" value="{{$post->user_id}}" form="commentForm">
                            <button type="submit" form="commentForm" class="btn btn-success feather-plus-circle"></button>
                        </div>
                        <form action="{{route('comment.store')}}" id="commentForm" class="mt-2" method="post">
                            @csrf
                            <textarea name="description" rows="3" placeholder="Comment on {{$post->owner}}'s post" class="form-control @error('description') is-invalid @enderror"></textarea>
                            @error('description')
                            <small class="invalid-feedback font-weight-bold" role="alert">
                                {{ $message }}
                            </small>
                            @enderror
                        </form>
                        <hr class="my-1">
{{--                        comments--}}
                        @php
                            $comments=\App\Comment::where('post_id',$post->id)->get();
                        @endphp
                        @forelse($comments as $cmt)
                            <div class=" py-2 pl-4">
                                <div class="d-flex">
                                    <img src="{{ \App\User::find($cmt->user_id)->photo ? asset('storage/profile/'.\App\User::find($cmt->user_id)->photo) : asset('images/user-default.png') }}" class="rounded-circle shadow-sm " style="width: 50px;height: 50px" alt="">
                                    <div class="d-flex flex-column ml-2 p-2" style="background-color: #f1f1f1;border-radius: 20px">
                                        <div class="d-felx">
                                        <span class="ml-0 ml-md-2 d-none d-md-inline-block font-weight-bold">
                                    {{\App\User::find($cmt->user_id)->name}}
                                </span>
                                            <span class="feather-clock text-primary ml-3"><p class="d-inline ml-1">{{$cmt->created_at->diffForHumans()}}</p></span>
                                        </div>
                                        <p class="mt-2 text-muted ml-2 " style="white-space: pre-line">{{$cmt->description}}</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="m-0 p-0">
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
