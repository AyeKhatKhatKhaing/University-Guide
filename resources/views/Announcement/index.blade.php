@extends('layouts.app')
@section("title")
    Announcement
@stop
@section("content")
    <x-bread-crumb>
        <li class="breadcrumb-item active" aria-current="page">Announcements</li>
    </x-bread-crumb>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="feather-list d-inline-block">Announcements</h4>
                    <a class="btn btn-outline-primary feather-plus-circle mr-3 float-right" href="{{ route('announcement.create') }}">Announce</a>
                    <hr>

                    <table class="table table-hover">
                        <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Controls</th>
                            <th>Created_at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($announcements as $ann)
                            <tr>
                                <td>{{$ann->id}}</td>
                                <td>
                                    {{ \Illuminate\Support\Str::words($ann->title,5) }}
                                </td>
                                <td>{{ strip_tags(html_entity_decode(\Illuminate\Support\Str::words($ann->description,20))) }}</td>
                                <td class="text-nowrap">
                                    <a href="{{route('announcement.show',$ann->id)}}" class="btn btn-sm btn-outline-info feather-info">
                                    </a>
                                    <a href="{{route('announcement.edit',$ann->id)}}" class="btn btn-sm btn-outline-primary feather-edit-2">
                                    </a>
                                    <form class="d-inline-block" action="{{route('announcement.destroy',[$ann->id,'page'=>request()->page])}}" method="post" id="delform{{$ann->id}}">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="id" value="{{$ann->id}}">
                                        <button type="button" class="btn btn-sm btn-outline-danger feather-trash" onclick="return banConfirm({{$ann->id}})"></button>
                                    </form>
                                </td>
                                <td class="text-nowrap"><i class="feather-calendar"></i>{{$ann->created_at->format("Y-m-d")}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">There is no Announcement</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        {{ $announcements->appends(request()->all())->links() }}
                        <p class="h4 font-weight-bolder ml-auto">Total : {{ $announcements->total() }}</p>
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
                title: `Are you sure to delete the Announcement ?`,
                text: "Announcement data ကိုဖျက်မှာ သေချာပါသလား ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9561e2',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        `Announcement ကို ဖျက်လိုက်ပါပြီ `,
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
