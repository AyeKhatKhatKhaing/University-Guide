<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','University')</title>
    <link rel="icon" href="{{asset('images/logo/logo.PNG')}}">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('vendor/feather-icons-web/feather.css')}}">


    <style>
        /*chat*/

        .pending{
            position: absolute;
            left: 10px;
            top: 4px;
            background-color: red;
            margin: 0;
            border-radius: 7px;
            width: 22px;
            height: 22px;
            line-height: 22px;
            padding-left: 5px;
            padding-right: 2px;
            color:white;
            font-size: 12px;
        }
        .messages{
            margin: 0;
            padding: 0;
        }
        .messages .message{
            margin-bottom: 15px;
        }
        .messages .message:last-child{
            margin-bottom: 0;
        }
        .received,.sent{
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }
        .received{
            background-color: #F4F4F4;
        }
        .sent{
            background-color: #4F7FCF;
            float: right;
            text-align: right;
            color: #f1f1f1;
        }
        .message p{
            margin: 5px 0;
        }
        .received .date{
            color: #777777;
            font-size: 12px;
        }

        .sent .date{
            color: #f0f0f0;
            font-size: 12px;
        }

        .active1{
            background-color: #F3F3F3;
        }
        .messages li{
            list-style: none;
        }
        .message-wrapper{
            height: 60vh;
            overflow-y: auto;
            padding: 10px;
        }
        .message-wrapper::-webkit-scrollbar {
            display: none; /* for Chrome, Safari, and Opera */
        }
        /*end-chat*/

        body{
            background: #f3f3f3;
        }
        body::-webkit-scrollbar {
            display: none; /* for Chrome, Safari, and Opera */
        }
        .noti{
            position: absolute;
        }
        .notiNum{
            position: relative;
            top: -17px;
            left: 10px;

        }

        .ann{
            height: 100vh;
            margin-bottom: 20px;
            overflow: scroll;
        }
        .ann::-webkit-scrollbar {
            display: none; /* for Chrome, Safari, and Opera */
        }
        .uniContainer{
            height: 100vh;
            overflow: scroll;
        }
        .uniContainer::-webkit-scrollbar {
            display: none; /* for Chrome, Safari, and Opera */
        }
        .uni-card{
            transition: .3s transform
        }
        .uni-card:hover{
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
        }
        .navbar{
            position: sticky;
            top: 0;
            z-index: 2000;
        }
        .search-box{
            border : 1px solid #4B7DCE;
            border-radius: 2rem;
            padding: 3px;
        }
        .search-input{
            flex-grow: 1;
            border: none !important;
            box-sizing: border-box;
            outline: none !important;
            border-radius: 2rem;
            padding-left: 20px;
            width: 300px;
        }
        .search-input:focus{
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }
        .note-modal{
            z-index: 5000 !important;
        }

        .search-btn{
            border-radius: 2rem;
            padding: 10px 25px;
            /* height: 40px; */
            /* line-height: 40px; */
            background: #4B7DCE;
            color: #fff;
            border: none;
            margin-left: -110px;
            margin-top:2px;
            margin-bottom:2px;
        }
        body {
            margin: 0;
            padding-top: 0;
        }

        /*nav {*/
        /*    margin: 0;*/
        /*    width: 100%;*/
        /*    transition: 1s;*/

        /*}*/

        /*nav ul {*/
        /*    width: 100%;*/
        /*    font-size: 16px;*/
        /*    border-radius: 8px;*/
        /*    text-decoration-line: none !important;*/
        /*}*/

        nav ul li a.active,
        nav ul li a:hover {
            font-weight: bold;
            /*text-transform: uppercase;*/
        }

        nav ul form {
            padding-top: 5px;
        }

        .text-white h1 {
            position: relative;
            text-transform: uppercase;
            margin-bottom: 30px;
            animation: animate 5s linear infinite;
        }

        @keyframes animate {
            0%,
            20%,
            40%,
            60%,
            80%,
            100% {
                color: rgba(23, 171, 245, 0.7);
            ;
                text-shadow: none;
            }
            20.5%,
            40.5%,
            60.5%,
            80.5%
            {
                color: white;
            }
        }
    </style>
    @yield('head')
</head>

<body>
<nav class="navbar navbar-expand-lg bg-primary bg-gradient">
    <div class="container-fluid col-12">
        <div class="d-flex">
            <button class="navbar-toggler btn-light feather-ba" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <i class="feather-list"></i>
            </button>
            <a class="navbar-brand py-0" href="{{route('uniView.index')}}" style="color: white;">
                <img src="{{asset('images/nav.png')}}" alt="logo" style="width: 50px;">
            </a>
            <div class=" d-none d-md-inline-block">
                <li class="d-inline nav-item">
                    <div id="search" >

                        <form action="{{ route('uniView.index') }}" method="get">
                            <div class="d-flex search-box">
                                <input type="text" class="form-control flex-shrink-1 me-2 search-input " value="{{request()->search}}" required name="search" placeholder="Search University">
                                <button class="btn btn-primary search-btn ml-2" type="submit"> <span class="d-none d-xl-block">Search</span> </button>
                            </div>
                        </form>

                    </div>
                </li>
            </div>
        </div>
        <div class="ms-auto me-3">
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarTogglerDemo03">
                <ul class="navbar-nav d-flex justify-content-between">
                    <div class="d-flex align-items-center justify-content-between ">
                        @if(\Illuminate\Support\Facades\Auth::user())
                            <div class="px-4">
                                <li class="animate__animated animate__pulse">
                                    <a href="{{route('userPost.feedIndex')}}" class="text-white d-block mr-3 pr-3">PostFeed</a>
                                </li>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::user()->role == '0')
                            <li class="animate__animated animate__pulse me-2 ">
                                <a href="{{route('dashboard')}}" class="text-white d-block me-3">Dashboard</a>
                            </li>
                                @endif
                        @else
                            <li class="animate__animated animate__pulse">
                                <a class="d-block mr-3" href="#exampleModal" data-mdb-toggle="modal">
                                    <span class="text-light d-block">Login</span>
                                </a>
                                <!--Login Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-secondary bg-light bg-gradient text-primary">
                                            <div class="modal-header d-block d-flex pb-0">
                                                <h5 class="modal-title" id="loginModalLabel">
                                                    Login
                                                </h5>
                                                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row justify-content-center align-items-center">
                                                    <div class="col-12 ">
                                                        <div class="mb-5 mt-2">
                                                            <div class="d-flex align-items-center justify-content-center mb-4">
                                                                <img src="{{asset(\App\Base::$logo)}}" style="width: 80px" alt="">
                                                            </div>
                                                            <div class="py-4 border bg-white rounded-lg shadow-sm">
                                                                <div class="pb-4 px-4 pt-2">
                                                                    <h2 class="text-center font-weight-normal">Sign In</h2>
                                                                    <p class="text-center text-black-50 mb-4">
                                                                        Don't have an account yet?
                                                                        <a href="#exampleModal1" data-mdb-toggle="modal">Sign up here</a>
                                                                    </p>
                                                                    <hr class="mb-3">
                                                                    <form action="{{ route('login') }}" method="post">
                                                                        @csrf
                                                                        <div class="form-outline mb-5">
                                                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required  autofocus>
                                                                            <label class="form-label" for="email">Email</label>
                                                                            @error('email')
                                                                            <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-outline mb-3">
                                                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required >
                                                                            <label for="password" class="form-label">Password</label>

                                                                            @error('password')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="d-flex justify-content-between align-items-center mt-4">
                                                                            <button type="submit" class="btn btn-primary btn-block me-3">Sign in</button>
                                                                            <a href="{{ route('forget.password.get') }}" class="text-nowrap">Forgot Password ?</a>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="animate__animated animate__pulse">
                                <a class="nav-link d-block" href="#exampleModal1" data-mdb-toggle="modal">
                                    <!-- <i class="fa-sharp fa-solid fa-registered fs-5"></i> -->
                                    <span class="text-light d-block">Register</span>
                                    <link rel="stylesheet" href="">
                                </a>
                                <!--Register Modal -->
                                <div class="modal fade modalfromstylesheet modalfromscript" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-light bg-gradient text-primary">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">
                                                    Registration Form
                                                </h5>
                                                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row justify-content-center align-items-center">
                                                    <div class="col-12">

                                                        <div class="mb-5 mt-2">
                                                            <div class="py-4 d-flex align-items-center justify-content-center ">
                                                                <img src="{{asset(\App\Base::$logo)}}" style="width: 80px" alt="">
                                                            </div>
                                                            <div class="border bg-white rounded-lg shadow-sm">
                                                                <div class="p-4">
                                                                    <h2 class="text-center font-weight-normal">Create Account</h2>
                                                                    <p class="text-center text-black-50 mb-4">
                                                                        Already have an account?
                                                                        <a href="#exampleModal" data-mdb-toggle="modal">Sign in here</a>
                                                                    </p>
                                                                    <form action="{{ route('register') }}" method="post">
                                                                        @csrf
                                                                        <div class="form-outline mb-4">
                                                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                                            <label class="form-label">Full Name</label>
                                                                            @error('name')
                                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                    </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-outline mb-4">
                                                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                                            <label class="form-label">Email</label>
                                                                            @error('email')
                                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                    </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-outline mb-4">
                                                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                                            <label class="form-label">Password</label>
                                                                            @error('password')
                                                                            <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-outline mb-4">
                                                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                                            <label class="form-label">Confirm Password</label>
                                                                        </div>
                                                                        <div class="form-outline mb-4 mb-5">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="accept-terms" name="accept-terms" required>
                                                                                <label class="custom-control-label text-muted" for="accept-terms">
                                                                                    I accept the Terms and Conditions
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-block btn-primary">Sign Up</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                            @if(\Illuminate\Support\Facades\Auth::user())

                                    @if(request()->url() != 'http://127.0.0.1:8000')
                                        <li class="animate__animated animate__pulse me-2 ms-3 ">
                                            @php
                                            if(\App\Announcement::count()>0){
                                                $last=\App\Announcement::latest('id')->first()->id;
                                                $count=\App\Announcement::where('id','>',\Illuminate\Support\Facades\Auth::user()->last_viewed_announcement)->count();
                                                }
                                                else{
                                                    $last='0';
                                                    $count='0';
                                                }
                                            @endphp
                                            <a href="{{route('uniView.announcement.index')}}" class="{{($count==0 || request()->url() == 'http://127.0.0.1:8000/universities/announcement')?'':'noti'}} text-white d-block ml-2 animate__animated animate__pulse "><i class="feather-bell fs-5"></i></a>

                                            @if(\Illuminate\Support\Facades\Auth::user()->last_viewed_announcement != $last )
                                                @if(request()->url() != 'http://127.0.0.1:8000/universities/announcement')
                                                    <span class="badge badge-danger text-white bg-danger py-1 badge-pill notiNum ">{{$count>0?$count:""}}</span>
                                                @endif
                                            @endif
                                        </li>
                                @endif

                            @endif
                    </div>
                </ul>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <!-- Avatar -->
            @if(\Illuminate\Support\Facades\Auth::user())
                <div class="ml-2 dropdown">

                    <img style="width:50px;height: 50px;" src="{{ isset(Auth::user()->photo) ? asset('storage/profile/'.Auth::user()->photo) : asset('images/user-default.png') }}" class="ml-3 rounded-circle shadow-sm" alt="">
                    <span class="ml-0 ml-md-2 d-none d-md-inline-block text-white">
                        {{\Illuminate\Support\Facades\Auth::user()->name}}
            </span>

                    <a class="link-light me-3 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="{{route('uniView.profile')}}">View profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <!-- Right elements -->
</nav>

@yield('content')
<script src="{{asset('js/myJs.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>

@auth
    @empty(\Illuminate\Support\Facades\Auth::user()->address)
        @include('user-profile.updateInfo')
    @endempty
@endauth

@include('message.toast')
@include('message.alert')

@yield('foot')
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    var receiver_id='';
    var my_id="{{\Illuminate\Support\Facades\Auth::id()}}";

    $(document).ready(function (){
        var token =  $('input[name="csrfToken"]').attr('value');

        Pusher.logToConsole = true;

        var pusher = new Pusher('e3ac405deb7cb18a8b6b', {
            cluster: 'ap1',
            forceTLS:true
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            if(my_id==data.from){
                $('#'+data.to).click();
            }
            else if(my_id==data.to){
                if(receiver_id==data.from){
                    $('#'+data.from).click();
                }
                else {
                    var pending=parseInt($('#'+data.from).find('.pending').html());
                    if(pending){
                        $('#'+data.from).find('.pending').html(pending+1)
                    }
                    else {
                        $('#'+data.from).append('<span class="pending">1</span>')
                    }
                }
            }
        });

        $('.user').click(function (){
            $('.user').removeClass('active1');
            $(this).addClass('active1');
            $(this).find('.pending').remove();

            receiver_id=$(this).attr('id');
            $.ajax({
                type:'get',
                url:'message/'+receiver_id,
                data:"",
                cache:false,
                success:function (data){
                    $('#message').html(data);
                    scrollToBottom();
                }
            })
        })

        $(document).on('click','.input-text button',function (e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var message=$(".input-text input").val();
            if(message!='' && receiver_id!=''){
                $(".input-text input").val('');

                var datastr="receiver_id=" + receiver_id + "&message=" +message;
                $.ajax({
                    type:"POST",
                    url:"messages",
                    data:datastr,
                    cache:false,
                    success:function (data){},
                    error:function (jqXHR,status,err){},
                    complete:function (){
                        scrollToBottom();
                    }

                })
            }
        })
    })

    function scrollToBottom(){
        $('.message-wrapper').animate({
            scrollTop:$('.message-wrapper').get(0).scrollHeight
        },50)
    }
</script>
</body>
</html>
