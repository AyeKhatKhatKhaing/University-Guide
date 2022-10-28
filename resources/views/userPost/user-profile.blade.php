@extends('master')
@section('title')
    Profile
@endsection
@section('head')
    <link rel="stylesheet" href="{{asset('vendor/summer_note/summernote.css')}}">
@endsection
@section('content')

    <div class="row justify-content-center" style="z-index: 3000">
        <div class="col-12 ">
            <x-uni-bread-crumb>
                <li class="breadcrumb-item bg-transparent"><a href="{{ route('userPost.feedIndex') }}">Post Feed</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </x-uni-bread-crumb>
        </div>
        <div class="col-12 col-md-4 ps-5 ">
            <div class="card">
                <div class="card-body">
                    <i class="h4 feather-user"></i>
                    <h4 class="d-inline">{{$user->name}}'s Profile</h4>
                    <hr>
                    <div class="d-flex justify-content-center mb-4">
                        <img style="width: 200px;height: 200px" class="rounded-circle d-block" src="{{ isset($user->photo)? asset('storage/profile/'.$user->photo) : asset('images/user-default.png')}}" alt="">
                    </div>
                    <div class="d-flex justify-content-center">
                        <p class="h4 text-muted text-center fw-bold d-inline px-3">{{$user->name}}</p>
                    </div>
                    <hr>
                    <div class="ps-5 mb-4"><i class="feather-mail text-success ml-3"></i><p class="h5 text-muted ms-3 d-inline-block">{{$user->email}}</p></div>
                    <div class="ps-5 mb-4"><i class="feather-phone text-primary ml-3"></i><p class="h5 text-muted ms-3 d-inline-block">{{$user->phone}}</p></div>
                    <div class="ps-5 mb-4"><i class="feather-map-pin text-warning ml-3"></i><p class="h5 text-muted ms-3 d-inline-block">{{$user->address}}</p></div>
                    <div class="ps-5 mb-4"><i class="feather-box text-info ml-3"></i><p class="h5 text-muted ms-3 d-inline-block">{{\App\Post::where('user_id',$user->id)->count()}} Posts</p></div>

                </div>
            </div>

        </div>
        <div class="ann col-12 border-start border-2 col-md-8 mb-5 pe-5">
            <div class="card">
                <div class="card-body p-3 d-flex justify-content-between">
                    <div>
                        <i class="h4 feather-box"></i>
                        <h4 class="m-0 d-inline">{{$user->name}}'s Post Wall</h4>
                    </div>
                    <div>
                        <a href="{{route('userPost.feedIndex')}}" class="feather-box btn btn-primary fs-6">Post Feed</a>
                    </div>
                </div>
            </div>
            @forelse(\App\Post::where('user_id',$user->id)->latest()->get() as $post)
                <div class="card mt-2">
                    <div class="card-body">
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

                            <a href="{{route('userPost.detail',$post->id)}}" class="btn btn-success rounded-pill text-center">Detail</a>
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
    </div>
@endsection

@section('foot')
    <script src="{{asset('vendor/summer_note/summernote.js')}}"></script>
    <script>
        const banConfirm=(id)=>{
            Swal.fire({
                title: `Are you sure to delete the University ?`,
                text: "Post ကိုဖျက်မှာ သေချာပါသလား ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9561e2',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        `Post ကို ဖျက်လိုက်ပါပြီ `,
                        'success'
                    )
                    setTimeout(function(){
                        $('#delform'+id).submit();
                    },1000)

                }
            })

        }
        $(document).ready(function() {
            $('.smn').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                ],
                height: 150,
                placeholder:"Post Anything ..."
            });
        });


    </script>
@endsection
