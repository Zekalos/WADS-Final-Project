@extends('layout.friends')

@section('title' , 'Search')
@section('friend')

<div class="row justify-content-center mt-3">
    <form class="form-inline" action="{{route('find', array('search' => "search" ))}}" method="GET" >
    <input class="form-control" name="search" type="search" placeholder="Search" aria-label="Search" value="{{old('search')}}">
        <button class="btn btn-outline-success ml-2" type="submit" >Search</button>
    </form>
</div>
<div class = "row mt-3">
    <div class = "col-12">
        <div class="col-sm-12">
            <table class="table table-bordered" width="100%" id="roomtable" cellspacing="0" role="grid">
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->firstname}} {{$user->lastname}}</td>
                        <td>{{$user->gender}}</td>
                        <td>{{$user->age}}</td>
                        <td>
                            <div class="btn-group">
                                <form action="{{route('add' , array('id' => $user->id))}}" method="POST">
                                    @csrf
                                    <button class="btn btn-success " type="submit">Add Friend</button>
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

@if (session('added'))
    <div class="alert alert-success">
        {{ session('added') }}
    </div>
@endif

@if (session('fails'))
    <div class="alert alert-danger">
        {{ session('fails') }}
    </div>
@endif

@endsection
