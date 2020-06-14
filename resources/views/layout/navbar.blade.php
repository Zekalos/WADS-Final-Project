<html>
<head>
    <link rel="icon" type="image" href="/image/icon.png">
    <title>
        @yield('title')
    </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: white;">
        <img src="/image/logo.png" alt="logo" style="height: 40px">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          <img src="/image/icon.png" alt="logo" style="height: 40px">
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav menu">
            <li class="nav-item">
              <a class="nav-link select" href="/home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/public">Public Chat</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/private">Private Chat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/people/friendlist">Friend</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Chat With Bot</a>
            </li>
          </ul>
        </div>
        <div>
            <form class="form-inline mt-3" method="GET" action="{{route('findroom', array('searchroom' => "searchroom" ))}}">
                <input name="searchroom" class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success ml-2"  type="submit">Search</button>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#staticBackdrop">
                    Create Room
                </button>
            </form>

                <!-- Create Room Modal -->
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create Room</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <form method="POST" action="{{route('create')}}">
                            @csrf
                            <div class="form-group row ml-2">
                                <label for="exampleFormControlInput1" class="col-form-label"> Room </label>
                                <div class="ml-4">
                                    <input type="text" name="name" class="form-control " id="exampleFormControlInput" placeholder="Room Name" aria-hidden="false" required>
                                </div>
                            </div>
                            <div class="form-group row ml-2">
                                <label for="exampleFormControlSelect1" class="col-form-label" ></label>Gender</label>
                                <div class="ml-4">
                                    <select name="gender" class="form-control" id="exampleFormControlSelect1" required>
                                        <option value="All">All</option>
                                        <option value="Male">Male Only</option>
                                        <option value="Female">Female Only</option>
                                    </select>
                                </div>
                                <label class="col-form-label ml-5" for="exampleFormControlSelect1">Age</label>
                                <div class="ml-2">
                                    <select name="age" class="form-control" id="exampleFormControlSelect1" required>
                                        <option value="0">All</option>
                                        <option value="13">13+</option>
                                        <option value="18">18+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="ml-2">
                                Maximum Member
                                <input name="max" type="number" class="Max ml-2" id="inputage" placeholder="10" min="10" max="40" required>
                            </div>
                            <div class="form-group row ml-2 mt-2">
                                <label for="exampleFormControlInput1">Topic <span>&nbsp &nbsp</span></label>
                                <textarea name="topic" class="form-control mr-5" id="exampleFormControlTextarea1" rows="2" placeholder="Insert a Topic" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               {{ Auth::user()->firstname}} {{ Auth::user()->lastname}}
            </a>
            <div class="dropdown-menu" aria-labelledby="User">
            <a class="dropdown-item" href="{{route('logout')}}">Log Out</a>
            </div>
        </div>
      </nav>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('container')

        <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <script>
            var receiverid = '';
            var receivername = '';
            var receiverlast = '';
            var userid = "{{Auth::user()->id}}";


            $(document).ready( function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
                    }
                });

                /*
                *
                * Private Chat
                *
                */

                Pusher.logToConsole = true;

                var pusher = new Pusher('882c8fb87b9f2ccaf02f', {
                cluster: 'ap1'
                });

                var channel = pusher.subscribe('my-channel');
                    channel.bind('message-sent', function(data) {
                    //alert(JSON.stringify(data));
                    if(userid == data.from){
                        $('#' + data.to).click(); //to make the sender updated as soon as it is sent
                    }else if(userid == data.to){
                        if(receiverid == data.from){
                            //if the receiver is selected, reload the selected user
                            $('#' + data.from).click().css("font-weight","");

                        }else{
                            //otherwise, add notification to the user
                            $('#' + data.from).find('.wait').css("font-weight","bold");

                        }
                    }
                });

                $(document).ready(function(){
                    $("#searchcontact").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $(".roompanel div").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                    });
                });



                // when contact is clicked

                $(".chat_list").click(function(){
                    $(".chat_list").removeClass('selected');
                    $(this).addClass('selected');

                    receiverid = $(this).attr('id');
                    receivername = $(this).attr('name');
                    receiverlast = $(this).attr('last');

                    $.ajax({ // get ajax request
                        type: 'GET' ,
                        url: 'private/' + receiverid,
                        data: "",
                        cache: false,
                        success: function(data){
                            $('.chat-panel').html(data);
                            $('.friendname').html(receivername + " " +receiverlast);
                            autoscroll();
                        }
                    });
                });


                $(document).on('keyup', '.input_field input', function(e){
                    var message = $(this).val();

                    //checking [enter] key and message not null
                    //uni keycode for [enter] key is 13
                    if(e.keyCode == 13 && message != '' && receiverid != ''){
                        $(this).val(''); // to empty the input text when the [enter] button is pressed
                        var inputdata = "receiverid=" + receiverid + "&message=" + message;
                        $.ajax({
                            type: 'POST' ,
                            url: 'private/' + receiverid + '/send',
                            data: inputdata,
                            cache: false,
                            success: function(data){

                            },
                            error: function(jqXHR, status, err){

                            },
                            complete: function(){
                                autoscroll();
                            }
                        })
                    }
                });

                // Search box
                $(document).ready(function(){
                    $("#searchroom").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $(".roompanel div").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                    });
                });
            });

            function autoscroll(){
                $('.scrollpage').animate({
                    scrollTop: $('.scrollpage').get(0).scrollHeight
                } , 50);
            }
        </script>


        <script>
            /*
            *
            * Public Chat
            *
            */

            $(document).ready( function(){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
                    }
                });

                Pusher.logToConsole = true;

                var pusher = new Pusher('882c8fb87b9f2ccaf02f', {
                cluster: 'ap1'
                });

                var channel = pusher.subscribe('my-channel');
                    channel.bind('message-sent', function(data) {
                    //alert(JSON.stringify(data));
                    if(userid == data.from){
                        $('#' + data.roomID).click(); //to make the sender updated as soon as it is sent
                    }else if(userid == data.roomID){
                        if(receiverid == data.roomID){
                            //if the receiver is selected, reload the selected user
                            $('#' + data.roomID).click().css("font-weight","");

                        }else{
                            //otherwise, add notification to the user
                            $('#' + data.roomID).find('.wait').css("font-weight","bold");

                        }
                    }
                });




                $(".chat_list_public").click(function(){
                    $(".chat_list_public").removeClass('selected');
                    $(this).addClass('selected');

                    roomid = $(this).attr('id');

                    //to get the joined roomname
                    $.ajax({ // get ajax request
                        type: 'GET' ,
                        url: 'public/' + roomid,
                        dataType: "json",
                        data: "",
                        cache: false,
                        success: function(data){
                            $('.roomsname').html(data[0].name);
                        }
                    });

                    $.ajax({ // get ajax request
                        type: 'GET' ,
                        url: 'public/' + roomid +'/chat',
                        data: "",
                        cache: false,
                        success: function(data){
                            //view(data);
                            $('.chat-panel_public').html(data);
                            autoscroll();
                        }
                    });
                });

                $(".leaveroom").click(function(){
                        $.ajax({ // get ajax request
                        type: 'POST' ,
                        url: 'public/' + roomid +'/delete',
                        data: "",
                        cache: false,
                        success: function(data){
                            alert("You have left the room, Please Refresh the page")
                        }
                        });
                    });


                $(document).on('keyup', '.input_field input', function(e){
                    var message = $(this).val();

                    //checking [enter] key and message not null
                    //uni keycode for [enter] key is 13
                    if(e.keyCode == 13 && message != '' && roomid != ''){
                        $(this).val(''); // to make the text entry when the [enter] button is pressed
                        var inputdata = "roomid=" + roomid + "&message=" + message;
                        $.ajax({
                            type: 'POST',
                            url: 'public/' + roomid + '/chat/send',
                            data: inputdata,
                            cache: false,
                            success: function(data){

                            },
                            error: function(jqXHR, status, err){

                            },
                            complete: function(){
                                autoscroll();
                            }
                        })
                    }
                });
            });
        </script>

</body>
</html>
