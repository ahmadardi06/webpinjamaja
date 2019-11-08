@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><span id="msgLogin">Sign In</span></div>

                <div class="card-body">
                    <div class="form-vertical">
                        <div class="form-group">
                            <label>Username:</label>
                            <input type="text" id="user" name="user" class="form-control" placeholder="Username...">
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" id="pass" name="pass" class="form-control" placeholder="Password...">
                        </div>
                        <div class="form-group">
                            <button id="idLogin" class="btn" style="background-color: red; color: white; border-radius: 20px;">Login</button>
                            <a href="{{ route('register') }}" style="margin-left: 20px; text-decoration: none;">Register</a>
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
            $('#idLogin').on('click', function(){
                var formData = { user: $('#user').val(), pass: $('#pass').val(), user_id: '1' };
                if(formData.user == '' || formData.pass == '') {
                    $('#msgLogin').html('User or pass must be filled!')
                    $('#user').focus()
                } else {
                    var linkURL = "{{ env('APP_API') }}/api/user/login.php";
                    $.post(linkURL, {name: formData.user, password: formData.pass}, function(data) {
                        if(!data.error) {
                            localStorage.setItem('user', JSON.stringify(data.data))
                            $('#msgLogin').html(data.message)
                            window.location.href = "{{ route('account') }}/account";
                        } else {
                            $('#msgLogin').html(data.message)
                        }
                    })
                }
            })
        })
    </script>
@endsection