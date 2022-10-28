@extends('master')
@section('content')
    <div class="row mt-3">
        <div class="col-md-1"></div>
        <div class="uniContainer col-12 col-md-8">

            @forelse($universities as $index=> $uni)
                <div class="uni-card card mt-2 {{$index==sizeof($universities)? 'mb-5':''}}">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="col-12 col-md-5">
                                <img src="{{isset($uni->photo) ? asset('storage/university/'.$uni->photo) : asset('images/user-default.png')}}" class="rounded-3" alt="" width="300px" height="300px">
                            </div>
                            <div class="col-12 col-md-7">
                                <div class="mb-2"><i class="feather-layers text-primary mr-2"></i><p class="d-inline h6 fw-bold">{{$uni->name}}</p></div>
                                <div class="mb-2"><p class="h6 fw-bold"><i class="feather-map-pin text-warning mr-1"></i>{{$uni->location}}</p></div>
                                <div class="mb-2"><p class="h6 fw-bold" class="d-inline-block mr-3"><i class="feather-check text-success mr-1"></i>{{date('Y')-1}} Entry Mark  :
                                    {{$uni->mark_one}}</p></div>
                                <div class="mb-2"><p class="h6 fw-bold" class="d-inline-block"><i class="feather-check text-success mr-1"></i>{{date('Y')-2}} Entry Mark  :
                                    {{$uni->mark_two}}</p></div>
                                <p class="">{{\Illuminate\Support\Str::words($uni->description,40)}}</p>
                                <a class="btn btn-sm btn-primary" href="{{route('uniView.detail',$uni->id)}}">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card mt-2 ">
                    <div class="card-body text-center">
                        <h2>OOPS!! </h2>
                        <h4>No university matched .</h4>
                    </div>
                </div>
            @endforelse
            <div class="d-flex justify-content-between">
                {{ $universities->appends(request()->all())->links() }}
            </div>
        </div>
        @if(sizeof($announcement)>0)
            <div class="col-12 col-md-3 ann">
            <div class="card mt-2 mr-2 shadow-none">
                <div class="card-body">
                    <p class="h4 d-block feather-alert-circle text-center text-primary fw-bold">Announcements</p>
                    <hr>
                    @php
                        $ann=\App\Announcement::latest('id')->first();
                    @endphp
                    <p class="h5 fw-bold" href="#">{{$ann->title}}</p>
                    <p class=" mb-0 mt-1"><i class="feather-calendar text-primary"></i>{{$ann->created_at}}</p>
                    <p style="white-space: pre-line">
                        {!! $ann->description !!}
                    </p>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection




