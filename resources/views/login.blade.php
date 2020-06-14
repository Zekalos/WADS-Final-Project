<!DOCTYPE html>
<head>
    <link rel="icon" type="image" href="/image/icon.png">
    <title>
        Login
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="/css/fontawesome.css">

</head>
<body>
    <div class="container bg-transparent">
            <div class="loginbox" id="boxlogin">
                <img class="center" src="/image/icon.png" alt="icon" style="height: 20%">
                <div class="row justify-content-center">
                    <div class="slide">
                        <div id="Button" class = "slide_btn">
                    </div>
                    &nbsp
                    <button type= "button" class="toogle" onclick="SignIn()">Login</button>
                    &nbsp &nbsp
                    <button type= "button" class="toogle" onclick="SignUp()"> Register</button>
                </div>

                <div class="Login mt-5" id = "Login" >
                    <form method="POST" action="{{route('login')}}">
                        @csrf
                    <div class="textbox row">
                        <div class="mt-4 col">
                                <i class="far fa-envelope"></i>
                        </div>
                            <input id="email" type="email" class="input @error('email') is-invalid @enderror col-10"  name="email" autocomplete="email" placeholder="e-mail" autofocus required >
                    </div>
                    <div class="textbox row">
                            <div class="mt-4 col">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" class="input mt-3 @error('password') is-invalid @enderror col-10" name="password" id="exampleInputPassword1" placeholder="Password" autocomplete="current-password" required>
                    </div>
                        <div class="BtnClass mt-5">
                            <button type="submit" class="login-btn">Login</button>
                        </div>
                    </form>
                </div>

                <div class="Register" id = "Register">
                    <form method="POST" action="{{route('register')}}">
                        @csrf

                        <div class="row">
                            <div class="col-5">
                            <input type="text" class="FName" name="firstname" placeholder="First name" value="{{old('firstname')}}" required>
                            </div>
                            <div class="col-5">
                                <input type="text" class="FName" name="lastname" placeholder="Last name" value="{{old('lastname')}}">
                            </div>
                        </div>
                        <div>

                        <input type="email" class="EmailRegister {{$errors-> has('email') ? 'is-invalid' : ''}}" name="email" id="inputEmail3" placeholder="Email" value="{{old('email')}}" required>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback ml-3">
                                    <small>This e-mail has already been taken</small>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-5">
                                <input type="password" class="Passwords {{$errors-> has('password') ? 'is-invalid' : ''}}" name="password" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback ml-3">
                                        <small>{{$errors->first('password')}}</small>
                                    </div>
                                @endif
                            </div>
                            <div class="col-5">
                                <input type="password" class="Passwords {{$errors-> has('re-password') ? 'is-invalid' : ''}}" name="re-password" placeholder="Re-Enter Password" required>
                                @if ($errors->has('re-password'))
                                    <script>
                                        var warning = "<?php echo "{$errors->first('re-password')}" ?>";
                                        window.alert(warning);
                                    </script>
                                @endif
                            </div>
                        </div>
                        <div>
                            <input type="number" class="Age ml-3" id="inputage" name="age" placeholder="Age" min="0" required>
                            <input type="checkbox" id="Male" name="gender" value="Male" onclick="males()">
                            <label id="gender">Male</label>
                            &nbsp;
                            <input type="checkbox" id="Female" name="gender" value="Female" onclick="females()">
                            <label id="gender">Female</label>
                        </div>
                        <div>
                            <div class="agreement">
                                <input type="checkbox" class="Agreementcheckbox" id="exampleCheck1" required>
                                <label class="form-check-label" for="exampleCheck1">I agree with the Terms and Conditions</label>
                            </div>
                            <button type="submit" class="register-btn mt-2">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <script>
        var login = document.getElementById("Login");
        var register = document.getElementById("Register");
        var button = document.getElementById("Button");
        var male = document.getElementById("Male");
        var female = document.getElementById("Female");
        var loginbox = document.getElementById('boxlogin');

        function SignUp(){
            login.style.marginLeft = "-1000px";
            register.style.marginLeft = "10px";
            button.style.left = "120px";
            loginbox.style.height = "520px";
        }

        function SignIn(){
            login.style.marginLeft = "0px";
            Register.style.marginLeft = "1000px";
            button.style.left = "0px";
            loginbox.style.height = "520px";
        }

        function females(){
            if(male.checked == true){
                male.checked = false;
                }
            }
        function males(){
            if(female.checked == true){
                female.checked = false;
                }
            }



    </script>
</body>
