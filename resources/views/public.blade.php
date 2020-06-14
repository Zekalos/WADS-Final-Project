<div class="scrollpage">
    @foreach ($messages as $message)
        @if ($message->from != Auth::user()->id)
            <div class="incoming">
                <div class="message_received">
                    @php
                        $user = DB::table('users')->where('id' , $message->from)->get();
                    @endphp
                    <div class="row ml-1">
                        <small class="col">{{ $user->pluck('firstname')->first() }} {{ $user->pluck('lastname')->first()}}</small>
                    </div>
                    <p class="row mt-1"> {{$message->message}}</p>
                    <div  class="received">
                        <small class="time_date mt-1"> {{ date('d M y | H:i a' , strtotime($message->created_at)) }}</small>
                    </div>
                </div>
            </div>
        @else
            <div class="outgoing">
                <div class="message_sent">
                        <p> {{$message->message}}</p>
                    <div  class="sent">
                        <small class="time_date"> {{ date('d M y | H:i a' , strtotime($message->created_at)) }}</small>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
<div class="type_msg mr-2">
    <div class="input_field">
        <input type="text" class="write_msg" placeholder="Type a message">

    </div>
</div>
