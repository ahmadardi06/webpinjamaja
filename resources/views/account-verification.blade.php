@extends('layouts.app')

@section('css')
	<link rel="stylesheet" href="{{ asset('tema/css/account-verification.css') }}">
@endsection

@section('content')
<div class="container">
    <a href="{{ route('email-verification') }}" class="btn  btn-list">Email</a>
    <a href="{{ route('phone-verification') }}" class="btn  btn-list">No. Telepon</a>
    <a href="{{ route('identity-verification') }}" class="btn  btn-list">Indetitas Diri</a>
</div>
@endsection