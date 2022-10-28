@extends('layouts.app')
@section("title")
    Post List
@stop
@section("content")
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Post List</li>
    </x-bread-crumb>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="feather-list">Post List</h4>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <a class="btn btn-outline-primary feather-plus-circle mr-3" href="{{ route('post.create') }}">Add Post</a>
                            @isset(request()->search)
                                <a class="btn btn-outline-dark feather-list mr-3" href="{{ route('post.index') }}">Post List</a>
                            @endisset
                        </div>
                        <form action="{{ route('post.index') }}" method="get">
                            <div class="form-inline">
                                <input type="text" class="form-control " name="search" placeholder="Search Post">
                                <button class="btn btn-primary feather-search ml-2" type="submit"></button>
                            </div>
                        </form>
                    </div>
                    <hr>

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
                        @forelse($posts as $post)
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

                    <div class="d-flex justify-content-between">
                        {{ $posts->appends(request()->all())->links() }}
                        <p class="h4 font-weight-bolder ml-auto">Total : {{ $posts->total() }}</p>
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
    </script>
@endsection
