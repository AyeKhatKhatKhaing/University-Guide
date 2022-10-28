@extends('layouts.app')
@section("title")
    University List
@stop
@section("content")
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Universities</li>
    </x-bread-crumb>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="feather-list">University List</h4>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <a class="btn btn-outline-primary feather-plus-circle mr-3" href="{{ route('university.create') }}">Add University</a>
                            @isset(request()->search)
                                <a class="btn btn-outline-dark feather-list mr-3" href="{{ route('university.index') }}">University List</a>
                            @endisset
                        </div>
                        <form action="{{ route('university.index') }}" method="get">
                            <div class="form-inline">
                                <input type="text" class="form-control " name="search" placeholder="Search University">
                                <button class="btn btn-primary feather-search ml-2" type="submit"></button>
                            </div>
                        </form>
                    </div>
                    <hr>

                    <table class="table table-hover">
                        <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Mark(Year 1)</th>
                            <th>Mark(Year 2)</th>
                            <th>Controls</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($universities as $university)
                            <tr>
                                <td>{{$university->id}}</td>
                                <td>
                                    {{ \Illuminate\Support\Str::words($university->name,3) }}
                                </td>
                                <td>
                                    {{ \Illuminate\Support\Str::words($university->location,10) }}
                                </td>
                                <td>{{ \Illuminate\Support\Str::words($university->description,10) }}</td>
                                <td>{{$university->mark_one}}</td>
                                <td>{{$university->mark_two}}</td>
                                <td class="text-nowrap">
                                    <a href="{{route('university.show',$university->id)}}" class="btn btn-sm btn-outline-info feather-info">
                                    </a>
                                    <a href="{{route('university.edit',$university->id)}}" class="btn btn-sm btn-outline-primary feather-edit-2">
                                    </a>
                                    <form class="d-inline-block" action="{{route('university.destroy',[$university->id,'page'=>request()->page])}}" method="post" id="delform{{$university->id}}">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="id" value="{{$university->id}}">
                                        <button type="button" class="btn btn-sm btn-outline-danger feather-trash" onclick="return banConfirm({{$university->id}})"></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">There is no University</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        {{ $universities->appends(request()->all())->links() }}
                        <p class="h4 font-weight-bolder ml-auto">Total : {{ $universities->total() }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop

@section('foot')
    <script>
        const banConfirm=(id)=>{
            Swal.fire({
                title: `Are you sure to delete the University ?`,
                text: "University data ကိုဖျက်မှာ သေချာပါသလား ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9561e2',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        `University data ကို ဖျက်လိုက်ပါပြီ `,
                        'success'
                    )
                    setTimeout(function(){
                        $('#delform'+id).submit();
                    },1000)

                }
            })

        }
    </script>
@endsection
