@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/account.css') }}">
@endsection

@section('content')
<div class="account-info" style="top: 30px;">
    <div class="profile-pic">
        <img src="{{ asset('tema/img/img1.jpg') }}">
    </div>
    <div class="profile-name">
        <span>Uzumaki Naruto</span>
    </div>
    <div class="profile-info">
        <span><i>uzumaki.naruto@gmail.com</i></span><br>
        <span><i>081234567898</i></span>
    </div>
</div>

<div class="container">
    <a href="{{ route('account-info') }}" class="btn  btn-list">Info Akun</a>
    <a href="#" class="btn  btn-list">Ganti Password</a>
    <a href="{{ route('account-verification') }}" class="btn  btn-list">Verifikasi Akun</a>
    <div class="about">
        <a href="#">Tentang PinjemAja</a>
    </div>
</div>
@endsection
