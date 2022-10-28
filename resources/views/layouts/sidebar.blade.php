<div class="col-12 col-lg-5 col-xl-2 sidebar">
    <div class="d-flex justify-content-between align-items-center py-2 mt-2 nav-brand">
        <div class="d-flex align-items-center justify-content-center rounded-2 mt-1  w-100 bg-white">
            <img src="{{asset(\App\Base::$logo)}}" style="width: 60px" alt="" class="m-auto">
        </div>
        <button class="hide-sidebar-btn btn btn-light d-block d-lg-none">
            <i class="feather-x text-primary" style="font-size: 2em;"></i>
        </button>
    </div>
    <div class="nav-menu fs-1">
        <ul>
            <x-menu-spacer></x-menu-spacer>
        @if(\Illuminate\Support\Facades\Auth::user()->role == 0)
                <x-menu-item name="Dashboard" class="feather-box" link="{{ route('dashboard') }}"></x-menu-item>
            @endif

            <x-menu-item name="Home" class="feather-home" link="{{ route('home') }}"></x-menu-item>
            <x-menu-spacer></x-menu-spacer>

            @if(\Illuminate\Support\Facades\Auth::user()->role == 0)
                <x-menu-title title="User Manager"></x-menu-title>
                <x-menu-item name="Users" class="feather-users" counter="{{$user->where('role','1')->count()}}" link="{{route('userManager.index')}}"></x-menu-item>
                <x-menu-spacer></x-menu-spacer>
            @endif

            <x-menu-title title="Manage University"></x-menu-title>
            @if(\Illuminate\Support\Facades\Auth::user()->role == 0)
                <x-menu-item name="Add University" class="feather-plus-circle" link="{{route('university.create')}}"></x-menu-item>
            @endif
            <x-menu-item name="Universities" class="feather-layers" counter="{{$university->count()}}" link="{{\Illuminate\Support\Facades\Auth::user()->role == 0?route('university.index'):route('userManager.userUniversity')}}"></x-menu-item>
            <x-menu-spacer></x-menu-spacer>

            <x-menu-title title="Announcement"></x-menu-title>
            <x-menu-item name="History" class="feather-layers" counter="{{$announcement->count()}}" link="{{route('announcement.index')}}"></x-menu-item>
            @if(\Illuminate\Support\Facades\Auth::user()->role == 0)
                <x-menu-item name="Announce" class="feather-plus-circle" link="{{route('announcement.create')}}"></x-menu-item>
            @endif
            <x-menu-spacer></x-menu-spacer>


            <x-menu-title title="Manage Posts"></x-menu-title>
            <x-menu-item name="Add Post" class="feather-plus-circle" link="{{route('post.create')}}"></x-menu-item>
            <x-menu-item name="Post List" class="feather-list" link="{{route('post.index')}}" counter="{{\App\Post::whereIn('user_id',\App\User::select('id')->get())->count()}}"></x-menu-item>
            <x-menu-spacer></x-menu-spacer>

            <x-menu-title title="Manage Profile"></x-menu-title>
            <x-menu-item name="Your Profile" class="feather-user" link="{{ route('profile') }}"></x-menu-item>
            <x-menu-item name="Password" class="feather-refresh-cw" link="{{ route('profile.edit.password') }}"></x-menu-item>
            <x-menu-item name="Information" class="feather-info" link="{{ route('profile.edit.info') }}"></x-menu-item>
            <x-menu-item name="Update photo" class="feather-image" link="{{ route('profile.edit.photo') }}"></x-menu-item>
            <x-menu-spacer></x-menu-spacer>

            <li class="menu-item">
                <a class="btn btn-outline-primary btn-block" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </li>
            <x-menu-spacer></x-menu-spacer>
        </ul>
    </div>
</div>
