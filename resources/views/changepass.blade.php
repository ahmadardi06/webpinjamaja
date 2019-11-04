@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><span id="msgLogin">Change Password</span></div>

                <div class="card-body">
                    <div class="form-vertical">
                        <div class="form-group">
                            <label>Current Password:</label>
                            <input type="password" id="currpass" name="user" class="form-control" placeholder="Password...">
                        </div>
                        <div class="form-group">
                            <label>New Password:</label>
                            <input type="password" id="newpass" name="newpass" class="form-control" placeholder="Password...">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password:</label>
                            <input type="password" id="confirmpass" name="confirmpass" class="form-control" placeholder="Password...">
                        </div>
                        <div class="form-group">
                            <button id="idLogin" class="btn" style="background-color: red; color: white; border-radius: 20px;">Change</button>
                            <a href="{{ route('account') }}" style="margin-left: 20px; text-decoration: none;">back</a>
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
            var userInfo = localStorage.getItem('user');
            var user = JSON.parse(userInfo);
            if(userInfo == null){
                window.location.href = linkOrigin+'/login';
            } else {
                $('#idLogin').on('click', function(){
                    var currPass = $('#currpass').val();
                    var newPass = $('#newpass').val();
                    var confirmPass = $('#confirmpass').val();

                    if(currPass == '' || newpass == '' || confirmPass == '') {
                        $('#msgLogin').html('All field must be filled!')
                    } else {
                        console.log('newPass: ', newPass)
                        console.log('confirmPass: ', confirmPass)
                        if(newPass != confirmPass) {
                            $('#msgLogin').html('New password and confirm password mismatch!')
                        } else {
                            var formData = {
                                id_user: user.id_user,
                                password: currPass,
                                new_password: newPass
                            }

                            var linkURL = "http://194.31.53.14/pinjem/api/user/changePassword.php";
                            $.post(linkURL, formData, function(data){
                                if(!data.error){
                                    $('#msgLogin').html(data.message)
                                    window.location.href = linkOrigin+'/account'
                                }
                            })
                        }
                    }
                })
            }
        })
    </script>
@endsection