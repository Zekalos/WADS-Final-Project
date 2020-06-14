@extends('layout.navbar')

@section('title' , 'Home')


@section('container')

@if (session('joined'))
<div class="alert alert-success">
    {{ session('joined') }}
</div>
@endif

@if (session('fails'))
<div class="alert alert-danger">
    {{ session('fails') }}
</div>
@endif

<body>
    <div class="container-fluid">
        <div class="card-body">
            <div class="row">
                <div class = "ml-3">
                    <h1>
                        All Rooms
                    </h1>
                </div>
            </div>
            <div class="row mt-2 roomtable">
                <div class="col-sm-12">
                    <table class="table table-bordered" id="roomtable" width="100%" cellspacing="0" role="grid">
                        <thead>
                            <tr role="row">


                                <th class="th-sm">Room</th>
                                <th class="th-sm">Topic</th>
                                <th class="th-sm">Gender</th>
                                <th class="th-sm">Capacity</th>
                                <th class="th-sm">Age</th>
                                <th class="th-sm">Host</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                            <tr role="row" class="odd">

                                <td>{{$room->name}}</td>
                                <td>{{$room->topic}}</td>

                                @if( $room->gender == "All")
                                    <td>{{$room->gender}}</td>
                                @else
                                    <td>{{$room->gender}} Only</td>
                                @endif
                                <td>{{DB::table('members')->where('roomID' , $room->id)->count('memberID')}} / {{$room->max}}</td>
                                <td>{{$room->age}}</td>
                                <td>{{$room->host}}</td>
                                <td>
                                    <form action="{{route('joined' , array('id' => $room->id))}}" method="POST">
                                        @csrf
                                        <button class="btn btn-success" type="submit">Join</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</body>


@endsection
