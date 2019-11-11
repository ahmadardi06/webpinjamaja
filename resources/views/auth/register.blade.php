@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><span id="msgRegister">Register</span></div>

                <div class="card-body">
                    <div class="form-vertical">
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email...">
                        </div>
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" id="user" name="user" class="form-control" placeholder="Username...">
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" id="pass" name="pass" class="form-control" placeholder="Password...">
                        </div>
                        <div class="form-group">
                            <button id="idRegister" class="btn" style="background-color: red; color: white; border-radius: 20px;">Register</button>
                            <a href="{{ route('login') }}" style="margin-left: 20px; text-decoration: none;">Login</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        var linkOrigin = window.location.origin;
        $(function(){
            $('#idRegister').on('click', function(){
                var formData = { email: $('#email').val(), user: $('#user').val(), pass: $('#pass').val(), user_id: '1' };
                if(formData.user == '' || formData.pass == '' || formData.email == '') {
                    $('#msgLogin').html('All field must be filled!')
                    $('#user').focus()
                } else {
                    var linkURL = "http://194.31.53.14/pinjem/api/user/register.php";
                    $.post(linkURL, {name: formData.user, password: formData.pass, email: formData.email}, function(data) {
                        if(!data.error) {
                            $('#msgRegister').html(data.message)
                            window.location.href = window.location.origin+'/login';
                        } else {
                            $('#msgRegister').html(data.message)
                        }
                    })
                }
            })
        })
    </script>
@endsection