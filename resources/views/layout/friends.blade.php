@extends('layout.navbar')

@section('title' , 'Friend')

@section('container')

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" >
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#friendbar" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <img src="/image/icon.png" alt="logo" style="height: 40px">
        </button>
        <div class="collapse navbar-collapse" id="friendbar">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="/people/friendlist"><b>Friend List</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/people/find"><b>Search</b></a>
                </li>
              </ul>
        </div>
    </nav>
    @yield('friend')
</div>



@endsection
