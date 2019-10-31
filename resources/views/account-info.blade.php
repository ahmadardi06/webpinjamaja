@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-pic">
        <img src="{{ asset('tema/img/img1.jpg') }}">
    </div>
    <form action="{{ route('account') }}" class="form">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Nama Lengkap">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="No. Telepon">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Alamat">
        </div>
        <button type="submit" style="width: 50%; background-color: red;" class="btn  btn-danger">Update</button>
    </form>
</div>
@endsection