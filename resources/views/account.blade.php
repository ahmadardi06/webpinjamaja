@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/account.css') }}">
@endsection

@section('content')
    <div class="account-info" style="top: 30px;">
        <div class="profile-pic">
            <img id="userPict" src="{{ asset('tema/img/img1.jpg') }}">
        </div>
        <div class="profile-name">
            <span id="userName">Anonymous</span>
        </div>
        <div class="profile-info">
            <span id="userEmail">anonymous@unknow.com</span><br>
            <span id="userPhone">phone</span>
        </div>
    </div>

    <div id="isLogin">
        <div class="container">
            <div id="isLogin">
                <a id="btnInfo" href="{{ route('account-info') }}" class="btn btn-list">Info Akun</a>
                <a id="btnGanti" href="#" class="btn  btn-list">Ganti Password</a>
                <a id="btnVerifikasi" href="{{ route('account-verification') }}" class="btn btn-list">Verifikasi Akun</a>
                <a id="btnLogout" href="#" class="btn btn-list">Logout</a>
                
                <div class="about" style="margin-bottom: 20px;">
                    <a href="#">Tentang PinjemAja</a>
                </div>
            </div>
        </div>
    </div>
    
    <div id="isLoged" class="container text-center">
        <a id="btnLogin" href="{{ route('login') }}" class="btn btn-list">Login</a>
    </div>
@endsection

@section('js')
    <script>
        var linkOrigin = window.location.origin;

        $(function(){
            var userInfo = localStorage.getItem('user');
            var user = JSON.parse(userInfo);
            if(userInfo == null){
                $('#isLogin').hide();
                $('#isLoged').show();
            } else {
                // var linkURL = linkOrigin+'/database/user.json';
                var linkURL = "http://194.31.53.14/pinjem/api/user/userDetail.php";
                $.post(linkURL, {id_user: user.id_user}, function(data){
                    $('#userPict').attr('src', data.img_user)
                    $('#userName').html(data.full_name)
                    $('#userEmail').html(data.email)
                    $('#userPhone').html(data.phone)
                })

                $('#isLogin').show();
                $('#isLoged').hide();
            }

            $('#btnLogout').on('click', function(){
                localStorage.clear();
                window.location.href = window.location.origin + '/login';
            })
        })
    </script>
@endsection