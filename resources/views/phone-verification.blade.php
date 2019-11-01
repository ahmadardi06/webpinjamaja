@extends('layouts.app')

@section('css')
	<link rel="stylesheet" href="{{ asset('tema/css/phone-verification.css') }}">
@endsection

@section('content')
<div class="container">
    <form action="{{ route('phone-verification') }}" class="form">
        <div class="form-group">
            <label>Mohon Lengkapi dengan nomor telepon yang aktif digunakan</label>
            <input type="text" class="form-control" placeholder="Nomor Telepon">
        </div>
        <a href="{{ route('account-verification') }}" style="padding: 8px; margin-right: 20px;" class="btn btn-danger btn-list">Batal</a>
        <button type="submit" class="btn btn-primary btn-list">Verifikasi</button>
    </form>
</div>
@endsection