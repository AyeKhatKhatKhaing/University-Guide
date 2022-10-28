@extends('layouts.app')
@section("title")
    User Manager
@stop
@section("content")
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">User Manager</li>
    </x-bread-crumb>

    <div class="row justify-content-center">
        <div class="col-12 ">
            @forelse($users as $user)
                <div class="shadow shadow-sm card my-1 rounded-2 ">
                    <div class="card-body py-2 user-list overflow-hidden">
                        <div class="row d-flex align-items-center">
                            <div class="h-25 col-6 col-md-3 text-nowrap">
                                <img src="{{isset($user->photo) ? asset('storage/profile/'.$user->photo) : asset('images/user-default.png')}}" class="user-img shadow-sm mr-1" alt="">
                                <span class="">{{\Illuminate\Support\Str::words($user->name,4)}}</span>
                            </div>
                            <div class="h-25 col-6 col-md-4 text-nowrap">
                                <i class="feather-mail text-success mr-1 mt-1"></i>
                                <span>{{$user->email}}</span>
                            </div>
                            <div class="h-25 col-6 col-md-3 text-nowrap">
                                <i class="feather-map-pin text-warning mr-1 mt-1"></i>
                                <span>{{\Illuminate\Support\Str::words($user->address,2)}}</span>
                            </div>
                            <div class="h-25  col-6 col-md-1 text-nowrap">
                                <span class="badge badge-pill bg-primary text-white">10</span> posts
                            </div>
                            <div class="h-25 col-6 col-md-1 text-nowrap ">
                                <div class="d-inline-block ml-2">
                                    <a href="{{route('userManager.userDetail',$user->id)}}" class="btn btn-sm btn-outline-info">
                                        <i class="feather-info"></i>
                                    </a>
                                </div>
                                @if($user->isBanned==1)
                                    <form class="d-inline-block" action="{{route('userManager.restoreUser')}}" method="post" id="restoreform{{$user->id}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$user->id}}">
                                        <button type="button" class="btn btn-sm btn-outline-success feather-upload" onclick="return restoreConfirm({{$user->id}})"></button>
                                    </form>
                                @else
                                    <form class="d-inline-block" action="{{route('userManager.banUser')}}" method="post" id="banform{{$user->id}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$user->id}}">
                                        <button type="button" class="btn btn-sm btn-outline-danger feather-lock" onclick="return banConfirm({{$user->id}})"></button>
                                    </form>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            @empty

            @endforelse
        </div>
    </div>
@stop
@section('foot')
    <script>
        const banConfirm=(id)=>{
            Swal.fire({
                title: `Are you sure to ban this user ?`,
                text: "User account ကိုပိတ်လိုက်မှာ ဖြစ်ပါတယ်။",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9561e2',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Banned!',
                        `User account ကို ပိတ်လိုက်ပါပြီ `,
                        'success'
                    )
                    setTimeout(function(){
                        $('#banform'+id).submit();
                    },1000)

                }
            })

        }

        const restoreConfirm=(id)=>{
            Swal.fire({
                title: `Are you sure to restore this user ?`,
                text: "User account ကိုပြန်လည်အသုံးပြုခွင့်ပေးမှာ ဖြစ်ပါတယ်။",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9561e2',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Restored!',
                        `User account ကို ပြန်လည်ဖွင့်လိုက်ပါပြီ `,
                        'success'
                    )
                    setTimeout(function(){
                        $('#restoreform'+id).submit();
                    },1000)

                }
            })

        }
    </script>
@endsection
