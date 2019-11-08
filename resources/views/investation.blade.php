@extends('layouts.app')

@section('css')
	<link rel="stylesheet" href="{{ asset('tema/css/investation.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="text-center">
        <img src="{{ asset('tema/img/store.png') }}" width="200" class="rounded" style="margin-top: 80px;">
        <br>
        <a id="linkInvestor" href="{{ route('rent-product') }}" class="btn btn-red" style="margin-top: 30px; border-radius: 20px; background-color: red; color: white;">
        	Sewakan Barang
        </a>
    </div>
</div>
@endsection

@section('js')
	<script>
		var userInfo = localStorage.getItem('user');
		var user = JSON.parse(userInfo);

		$(function(){
			// var linkURL = "{{ env('APP_API') }}/api/user/userDetail.php";
			// $.post(linkURL, {id_user: user.id_user}, function(data){
				
			// })
		})
	</script>
@endsection