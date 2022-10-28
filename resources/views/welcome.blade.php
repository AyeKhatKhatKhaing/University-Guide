@extends('master')
@section('content')

<header>
    <!-- Intro settings -->
    <style>
        /* Default height for small devices */

        #intro-example {
            height: 100vh;
        }
        /* Height for devices larger than 992px */

        @media (min-width: 992px) {
            #intro-example {
                height: 100vh;
            }
        }
    </style>
    <!-- Background image -->
    <div id="intro-example" class="p-5 text-center bg-image" style="background-image: url('{{asset('images/bg.png')}}');">
        <div class="mask" style="background-color: rgba(34, 33, 33, 0.7);">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-white">

                    <h1 class="font-weight-bolder">Search All Universities In Myanmar</h1>
                    <h5 class=" font-weight-bolder mb-2">Best & free guide of university</h5>
                    <h5 class=" font-weight-bolder mb-5">and make sure to contact with your friends.</h5>
                    @if(\Illuminate\Support\Facades\Auth::user())
                        <a class="btn btn-outline-light btn-lg" href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <a class="btn btn-outline-light btn-lg " href="#exampleModal" data-mdb-toggle="modal">Login</a>
                    @endif
                    <a class="btn btn-outline-light btn-lg " href="{{route('uniView.index')}}">Universities</a>
                </div>

            </div>
        </div>
    </div>

    <!-- Background image -->

</header>
@endsection
