@extends('layouts.app')

@section('css')
	<link rel="stylesheet" href="{{ asset('tema/css/investation.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="text-center">
        <img src="{{ asset('tema/img/img1.jpg') }}" width="200" class="rounded" style="margin-top: 80px;">
        <br>
        <a href="#" class="btn" style="margin-top: 30px; border-radius: 20px; background-color: red; color: white;">
        	Mulai Menyewakan
        </a>
    </div>
</div>
@endsection
