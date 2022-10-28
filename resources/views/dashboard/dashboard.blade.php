@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card mb-4 status-card" onclick="">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-3 feather-home h1 text-primary"></div>
                        <div class="col-9">
                            <p class="mb-1 h4 font-weight-bolder">
                                <span class="counter-up">{{$university->count()}}</span>
                            </p>
                            <p class="mb-0 text-black-50">Total Universities</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card mb-4 status-card" onclick="">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-3 feather-users h1 text-primary"></div>
                        <div class="col-9">
                            <p class="mb-1 h4 font-weight-bolder">
                                <span class="counter-up">{{$user->count()-1}}</span>
                            </p>
                            <p class="mb-0 text-black-50">Total Users</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card mb-4 status-card" onclick="">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-3 feather-list h1 text-primary"></div>
                        <div class="col-9">
                            <p class="mb-1 h4 font-weight-bolder">
                                <span class="counter-up">{{$posts->count()}}</span>
                            </p>
                            <p class="mb-0 text-black-50">Total Posts</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card mb-4 status-card" onclick="go">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-3 feather-map-pin h1 text-primary"></div>
                        <div class="col-9">
                            <p class="mb-1 h4 font-weight-bolder">
                                <span class="counter-up">{{\App\User::distinct()->count('address')}}</span>
                            </p>
                            <p class="mb-0 text-black-50">Locations</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row align-items-end">
        <div class="col-12 col-md-8 mb-4">
            <div class="card overflow-hidden shadow">
                <div class="">
                    <div class="d-flex justify-content-between align-items-center p-2">
                        <h4 class="mb-0">Login Users In The Last 10 Days</h4>
                        <div class="">
                            @foreach(\App\User::latest()->get() as $i=>$img)
                                @if($i < 5)
                                    <img src="{{$img->photo?asset('storage/profile/'.$img->photo) : asset('images/user-default.png')}}" class="rounded-circle" style="margin-left: -20px;width: 40px;height: 40px" alt="">
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <canvas id="ov" height="150"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-4 overflow-hidden">
                <div class="">
                    <div class="d-flex justify-content-between align-items-center p-2">
                        <h4 class="mb-4 mt-2 font-weight-bold">Admin's Posts This month</h4>
                        <div class="">
                            <?php
                            $current=\Illuminate\Support\Facades\Auth::id();
                            $totalPost= $posts->count();
                            $currentUserPost= \App\Post::where('user_id',\Illuminate\Support\Facades\Auth::id())->count();
                            $currentUserPostPercentage=($currentUserPost/$totalPost)*100;
                            $finalPercentage=floor($currentUserPostPercentage);
                            ?>
                            <small>Your posts : <?php echo $currentUserPost ?> in total <?php echo $totalPost ?></small>
                            <div class="progress" style="width:350px">
                                <div class="progress-bar progress-bar-animated progress-bar-striped bg-primary"
                                     role="progressbar" aria-label="Success striped example"
                                     style="width:<?php echo $finalPercentage ?>% " aria-valuenow="25" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>Description</th>
                            <th>Owner</th>
                            <th>Comment</th>
                            <th>Controls</th>
                            <th>Created_At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse(\App\Post::where('user_id',\Illuminate\Support\Facades\Auth::id())->latest()->get() as $post)
                            @if(!empty(\App\User::find($post->user_id)))
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>
                                        {{ strip_tags(html_entity_decode(\Illuminate\Support\Str::words($post->description,10))) }}
                                    </td>
                                    <td>{{\Illuminate\Support\Str::words($post->owner,5)}}</td>
                                    <td class="">{{\App\Comment::where('post_id',$post->id)->count()}} comments</td>
                                    <td class="text-nowrap">
                                        <a href="{{route('post.show',$post->id)}}" class="btn btn-sm btn-outline-info feather-info">
                                        </a>
                                        <a href="{{route('post.edit',$post->id)}}" class="btn btn-sm btn-outline-primary feather-edit-2">
                                        </a>
                                        <form class="d-inline-block" action="{{route('post.destroy',[$post->id,'page'=>request()->page])}}" method="post" id="delform{{$post->id}}">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{$post->id}}">
                                            <button type="button" class="btn btn-sm btn-outline-danger feather-trash" onclick="return banConfirm({{$post->id}})"></button>
                                        </form>
                                    </td>
                                    <td>{{$post->created_at->diffForHumans()}}</td>

                                </tr>
                            @endif

                        @empty
                            <tr>
                                <td colspan="6" class="text-center">There is no Posts</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot')
    <script src="{{asset('vendor/way_point/jquery.waypoints.js')}}"></script>
    <script src="{{asset('vendor/counter_up/counter_up.js')}}"></script>
    <script src="{{asset('vendor/chart_js/chart.min.js')}}"></script>
    <script>
        $('.counter-up').counterUp({
            delay: 10,
            time: 1000
        });




        <?php
        function conn()
        {
            return mysqli_connect("localhost", "root", "", "university_guide");
        }
        function fetch($sql)
        {
            $query = mysqli_query(conn(), $sql);
            $row = mysqli_fetch_assoc($query);
            return $row;
        }
        function countTotal($table,$condition=1)
        {
            $sql = "SELECT COUNT(id) FROM $table WHERE $condition";
            $total = fetch($sql);
            return $total['COUNT(id)'];
        }

        $dateArr=[];
        $visitors=[];
        $today=date("Y-m-d");
        for ($i=1;$i<=10;$i++){
            $date=date_create($today);
            date_sub($date,date_interval_create_from_date_string("$i days"));
            $current=date_format($date,"Y-m-d");
            array_push($dateArr,$current);

            $total=countTotal('users',"CAST(created_at AS DATE) = '$current'");
            array_push($visitors,$total);

        }
        ?>

        let dateArray = <?php echo json_encode($dateArr) ?>;
        let viewerCountArr = <?php echo json_encode($visitors) ?>;
        const ctx = document.getElementById('ov').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dateArray,
                datasets: [{
                    label: 'Visitor count',
                    data: viewerCountArr,
                    backgroundColor: [
                        '#28c7fa',
                    ],
                    borderColor: [
                        '#007bff',
                    ],
                    tension: 0,
                    borderWidth: 1
                },
                ]
            },
            options: {
                scales: {
                    y: [{
                        display: false,
                        beginAtZero: true,
                    }],

                    x: [{
                        display: false,
                        gridLines: {
                            drawBorder: false,
                        },
                    }]
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontColor: '#333',
                        usePointStyle: true,
                    }
                }

            }
        });

    </script>
@endsection

