
<div class="scrollpage">
    @foreach($messages as $message)
        <div class="{{ ($message->from == Auth::user()->id) ? 'outgoing' : 'incoming'}}">
            <div class="{{ ($message->from == Auth::user()->id) ? 'message_sent' : 'message_received'}}">
                <p> {{$message->message}}</p>
                <div  class="{{ ($message->from == Auth::user()->id) ? 'sent' : 'received'}}">
                    <small class="time_date"> {{ date('d M y | H:i a' , strtotime($message->created_at)) }}</small>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="type_msg mr-2">
    <div class="input_field">
        <input type="text" class="write_msg" placeholder="Type a message" style="border: 1px salmon solid; border-radius:10px; margin-top:1px;">
    </div>
</div>








