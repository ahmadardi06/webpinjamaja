@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/account-info.css') }}">
@endsection

@section('content')

<div class="container">
    <div class="profile-pic">
        <img src="{{ asset('tema/img/img1.jpg') }}">
    </div>
    <form action="{{ route('account') }}" class="form">
        <div class="form-group">
            <input type="text" class="form-control" id="fullname" placeholder="Nama Lengkap">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="phone" placeholder="No. Telepon">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="address" placeholder="Alamat">
        </div>
        <button type="submit" style="width: 50%; background-color: red;" class="btn  btn-danger">Update</button>
    </form>
</div>
@endsection

@section('js')
    <script>
        var linkOrigin = window.location.origin;

        $(function(){
            var linkURL = linkOrigin+"/database/user.json";
            $.get(linkURL, function(data){
                $('#fullname').val(data.full_name)
                $('#email').val(data.email)
                $('#phone').val(data.phone)
                $('#address').val(data.address)
            })
        })
    </script>
@endsection