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
        $(function(){
            $('#idLogin').on('click', function(){
                var formData = { user: $('#user').val(), pass: $('#pass').val(), user_id: '1' };
                if(formData.user == 'ahmad' && formData.pass == 'ardiansyah') {
                    localStorage.setItem('user', JSON.stringify(formData))
                    window.location.href = window.location.origin+'/account';
                } else {
                    $('#msgLogin').html('User or pass mismatch!')
                }
            })
        })
    </script>
@endsection