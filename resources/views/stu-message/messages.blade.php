<div class="card ">
    <div class="card-body ">
        <div class="message-wrapper">
            <ul class="messages">
                @forelse($messages as $message)
                    <li class="message clearfix">
                        <div class="{{$message->from == \Illuminate\Support\Facades\Auth::id()?'sent':'received'}} ms-2">
                            @if($message->from != \Illuminate\Support\Facades\Auth::id())
                            <div class="d-flex mt-1">
                                    <img src="{{ \App\User::find($message->from)->photo ? asset('storage/profile/'.\App\User::find($message->from)->photo) : asset('images/user-default.png') }}" class="rounded-circle shadow-sm " style="width: 40px;height: 40px" alt="">
                                <div class="ms-2">
                                    <p>{{$message->message}}</p>
                                    <p class="date">{{$message->created_at->diffForHumans()}}</p>
                                </div>
                            </div>
                            @else
                                <div class="ms-2">
                                    <p>{{$message->message}}</p>
                                    <p class="date">{{$message->created_at->diffForHumans()}}</p>
                                </div>
                            @endif

                        </div>


                    </li>
                @empty
                @endforelse
            </ul>
        </div>

    </div>
</div>
<div class=" my-2">
        <div class="d-flex input-text">
            <input type="text"  name="message" class="submit form-control" placeholder="Enter New Message...">
            <button class="btn btn-primary feather-send fs-6 mx-3 msg-btn" type="submit"></button>
        </div>
</div>
