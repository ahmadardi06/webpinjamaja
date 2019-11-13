@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><span id="msgLogin">Ganti Password</span></div>

                <div class="card-body">
                    <div class="form-vertical">
                        <div class="form-group">
                            <label>Password Sekarang:</label>
                            <input type="password" id="currpass" name="user" class="form-control" placeholder="Password...">
                        </div>
                        <div class="form-group">
                            <label>Password Baru:</label>
                            <input type="password" id="newpass" name="newpass" class="form-control" placeholder="Password...">
                        </div>
                        <div class="form-group">
                            <label>Ketik Ulang Password:</label>
                            <input type="password" id="confirmpass" name="confirmpass" class="form-control" placeholder="Password...">
                        </div>
                        <div class="form-group">
                            <button id="idLogin" class="btn" style="background-color: red; color: white; border-radius: 20px;">Changubah</button>
                            <a href="{{ route('account') }}" style="margin-left: 20px; text-decoration: none;">kembali</a>
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
                window.location.href = "{{ route('login') }}";
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

                            var linkURL = "{{ env('APP_API') }}/api/user/changePassword.php";
                            $.post(linkURL, formData, function(data){
                                if(!data.error){
                                    $('#msgLogin').html(data.message)
                                    window.location.href = "{{ route('account') }}";
                                }
                            })
                        }
                    }
                })
            }
        })
    </script>
@endsection