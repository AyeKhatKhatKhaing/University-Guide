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
                        @forelse($university as $uni)
                            <tr>
                                <td>{{$uni->id}}</td>
                                <td>
                                    {{ \Illuminate\Support\Str::words($uni->name,3) }}
                                </td>
                                <td>
                                    {{ \Illuminate\Support\Str::words($uni->location,10) }}
                                </td>
                                <td>{{ \Illuminate\Support\Str::words($uni->description,10) }}</td>
                                <td>{{$uni->mark_one}}</td>
                                <td>{{$uni->mark_two}}</td>
                                <td class="text-nowrap">
                                    <a href="{{route('university.show',$uni->id)}}" class="btn btn-sm btn-outline-info feather-info">
                                    </a>
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
                        {{ $university->appends(request()->all())->links() }}
                        <p class="h4 font-weight-bolder ml-auto">Total : {{ $university->total() }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop
