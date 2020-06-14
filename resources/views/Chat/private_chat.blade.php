@extends('layout/navbar')
@section('title' , 'Private-Chat')

@section('container')

<div class="container">
    <div class="row no-gutters">
        <div class="room col-3">
            <div class="mt-0">
                <div class="searchbox">
                    <input class="form-control" id="searchcontact" type="search" placeholder="Search" aria-label="Search">
                </div>
            </div>
            <div class="vertical">
            </div>
        </div>
        <div class="roomname col">
            <h3 class= "friendname">

            </h3>
        </div>
        <div class="col">
            <h3 class= "features">

            </h3>
        </div>
    </div>
    <div class="horizontal">
    </div>
    <div class="roomcontainer">
        <div class="roompanel">
            @foreach ($friends as $friend)
                    <div class="chat_list" id = {{$friend->id}} name={{$friend->firstname}} last={{$friend->lastname}}>
                        <div class="contact">
                            <div class="chat_content">
                                <h5 class="wait">{{$friend->firstname}} {{$friend->lastname}} <span>{{$friend->age}}</span></h5>
                                <span>{{$friend->gender}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    <div class="chat-panel">

    </div>

</div>

@endsection
