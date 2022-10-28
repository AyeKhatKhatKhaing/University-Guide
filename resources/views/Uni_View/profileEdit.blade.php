@extends('master')
@section('title')
    Edit Profile
@endsection
@section('head')
    <link rel="stylesheet" href="{{asset('vendor/summer_note/summernote.css')}}">
@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-12 ">
            <x-uni-bread-crumb>
                <li class="breadcrumb-item bg-transparent"><a href="{{ route('uniView.profile') }}">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
            </x-uni-bread-crumb>
        </div>
        <div class="col-12 col-md-4 mb-4 ps-5 ann">
            <form action="{{route('uniView.profile-update')}}" id="profileForm" method="post" enctype="multipart/form-data">
                @csrf
            </form>
            <div class="card" style="margin-bottom: 50px">
                <div class="card-body">
                    <h4>Edit Profile</h4>
                    <hr>
                    <div class="form-group ">
                        <img id="previewImg" onclick="$('#photo').trigger('click');" class="rounded-circle d-block mx-auto"
                             src="{{isset(Auth::user()->photo) ? asset('storage/profile/'.Auth::user()->photo) : asset('images/user-default.png')}}" alt="your image" style="width: 200px;height: 200px"/>
                        <i class="me-2 feather-image"></i>
                        <label for="photo">
                            Profile Photo
                        </label>
                        <input form="profileForm" type="file" id="photo" onchange="previewFile(this);" name="photo"
                               class="form-control p-1 mr-2 overflow-hidden @error('photo') is-invalid @enderror" >
                        @error('photo')
                        <small class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 pb-3 mt-4">
                        <i class="feather-user text-primary me-2"></i><label for="" class="d-inline">Name</label>
                        <input type="text" name="pname" value="{{$user->name}}"  form="profileForm" class="form-control @error('pname') is-invalid @enderror">
                        @error('pname')
                        <small class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 pb-3">
                        <i class="feather-user text-primary me-2"></i><label for="" class="d-inline">Current Password</label>
                        <input type="password"  form="profileForm" class="form-control @error('pcurrentPassword') is-invalid @enderror" name="pcurrentPassword">
                        @error('pcurrentPassword')
                        <small class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 pb-3">
                        <i class="feather-user text-primary me-2"></i><label for="" class="d-inline">New Password</label>
                        <input type="password"  form="profileForm" class="form-control " name="newPassword">

                    </div>
                    <div class="form-group mb-3 pb-3">
                        <i class="feather-user text-primary me-2"></i><label for="" class="d-inline">Confirm Password</label>
                        <input type="password"  form="profileForm" class="form-control @error('confirmPassword') is-invalid @enderror" name="confirmPassword">
                        @error('confirmPassword')
                        <small class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>
                    <div class="form-group mb-4  pb-3">
                        <i class="feather-user text-primary me-2"></i><label for="" class="d-inline">Phone</label>
                        <input type="text"  value="{{$user->phone}}" form="profileForm" class="form-control @error('phone') is-invalid @enderror" name="phone">
                        @error('phone')
                        <small class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 pb-3 ">
                        <i class="feather-user text-primary me-2"></i><label for="" class="d-inline">Address</label>
                        <textarea type="text" name="address"  form="profileForm" class="form-control @error('address') is-invalid @enderror"  style="white-space: pre-line">{{$user->address}}</textarea>
                        @error('address')
                        <small class="invalid-feedback font-weight-bold" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <button type="submit" form="profileForm" class="btn btn-primary fs-6 btn-block"><i class="feather-upload me-2"></i>Update</button>
                </div>
            </div>

        </div>
        <div class="ann col-12 border-start border-2 col-md-8 mb-5 pe-5">
            <div class="card">
                <div class="card-body p-3">
                    <i class="h4 feather-box"></i>
                    <h4 class="m-0 d-inline">Your Post Wall</h4>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body p-3 mb-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <img src="{{ isset(Auth::user()->photo) ? asset('storage/profile/'.Auth::user()->photo) : asset('images/user-default.png') }}" class="rounded-circle shadow-sm " style="width: 50px;height: 50px" alt="">
                            <span class="h5 ml-0 ml-md-2 d-none d-md-inline-block text-muted font-weight-bold">
                        {{\Illuminate\Support\Facades\Auth::user()->name}}
                    </span>
                        </div>
                        <div>
                            <button type="submit" form="postForm" class="btn btn-primary feather-plus-circle fs-6">Post</button>
                            <form action="{{route('userPost.create')}}" method="post" id="postForm" enctype="multipart/form-data">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <hr class="mt-1">
                    <div class="form-group mt-2 mb-0" >
                        <textarea type="text" name="description" form="postForm"  class="mb-3 smn form-control mt-2 @error('description') is-invalid @enderror"></textarea>
                        @error('description')
                        <small class="invalid-feedback font-weight-bold mt-1" role="alert">
                            {{ $message }}
                        </small>
                        @enderror
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
                            <div>
                                <a href="{{route('userPost.edit',$post->id)}}" class="btn btn-sm btn-primary feather-edit fs-6"></a>
                                <form class="d-inline-block" action="{{route('userPost.destroy',$post->id)}}" method="post" id="delform{{$post->id}}">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{$post->id}}">
                                    <button type="button" class="btn fs-6 btn-sm btn-danger feather-trash" onclick="return banConfirm({{$post->id}})"></button>
                                </form>
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
