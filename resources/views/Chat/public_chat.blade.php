@extends('layout/navbar')
@section('title' , 'Public-Chat')

@section('container')

@if (session('LeaveRoom'))
    <div class="alert alert-danger">
        {{ session('LeaveRoom') }}
    </div>
@endif

<div class="container">
        <div class="row no-gutters">
            <div class="room col-3">
                <div class="mt-0">
                    <div class="searchbox">
                        <input class="form-control" type="search" id="searchroom" placeholder="Search" aria-label="Search">
                    </div>
                </div>
                <div class="vertical">
                </div>
            </div>
            <div class="roomname col">
                <h3 class= "roomsname">

                </h3>
            </div>
        </div>
    <div class="horizontal">
    </div>
    <div class="roomcontainer">
        <div class="roompanel">

            @foreach ($rooms as $room)
            <div class="chat_list_public" id = {{$room->id}}>
                <div class="contact row">
                    <div class="chat_content col">
                        <h5 class="wait">
                            {{$room->name}}
                        </h5>
                        <small>
                            {{$room->topic}}
                        </small>
                    </div>
                     <button type="button" style="padding: 0% " class="leaveroom col ml-3 mr-1 mt-2" action ={{route('leaveroom' , $room->id)}}>Leave Room</button>
                </div>
            </div>
        @endforeach
        </div>
    </div>

        <div class="chat-panel_public">

        </div>


</div>

@endsection
