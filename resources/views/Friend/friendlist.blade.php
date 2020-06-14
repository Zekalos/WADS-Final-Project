@extends('layout.friends')

@section('title' , 'FriendList')
@section('friend')

@if (session('removed'))
    <div class="alert alert-danger">
        {{ session('removed') }}
    </div>
@endif

<div class = "row mt-3">
    <div class = "col-12">
        <div class="col-sm-12">
            <table class="table table-bordered" width="100%" id="roomtable" cellspacing="0" role="grid">
                <thead>
                    <tr role="row">
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Gender</th>
                        <th class="th-sm">Age</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($friends as $friend)
                        <td>{{$friend->firstname}} {{$friend->lastname}}</td>
                        <td>{{$friend->gender}}</td>
                        <td>{{$friend->age}}</td>
                        <td>
                            <div class="btn-group">
                                <form action="{{route('unfriend' , array('id' => $friend->id))}}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger ml-3" type="submit" onclick="">Unfriend</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>

@endsection
