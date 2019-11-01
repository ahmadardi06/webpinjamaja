@extends('layouts.app')

@section('css')
	<link rel="stylesheet" href="{{ asset('tema/css/email-verification.css') }}">
@endsection

@section('content')
<div class="container">
    <form action="{{ route('email-verification') }}" class="form">
        <div class="form-group">
            <label>Mohon Lengkapi dengan alamat email yang aktif</label>
            <input type="email" class="form-control" placeholder="Email">
        </div>
        <a href="{{ route('account-verification') }}" style="padding: 8px; margin-right: 20px;" class="btn btn-danger btn-list">Batal</a>
        <button type="submit" class="btn btn-primary btn-list">Verifikasi</button>
    </form>
</div>
@endsection