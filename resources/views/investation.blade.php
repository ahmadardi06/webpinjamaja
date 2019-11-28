@extends('layouts.app')

@section('css')
	<link rel="stylesheet" href="{{ asset('tema/css/investation.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="text-center">
        <img src="{{ asset('tema/img/store.png') }}" width="200" class="rounded" style="margin-top: 80px;">
        <br>
        <button id="linkInvestor" class="btn btn-red" style="margin-top: 30px; border-radius: 20px; background-color: red; color: white;">
        	Sewakan Barang
        </button>
    </div>
</div>
@endsection

@section('js')
	<script>
		var userInfo = localStorage.getItem('user');
		var user = JSON.parse(userInfo);
		var myOrigin = window.location.origin;

		$(function(){
			if(userInfo == null){
				window.location.href = "{{ route('login') }}";
			} else {
				var linkUser = "{{ env('APP_API') }}/api/baskets/updateverifikasi.php?id_user="+user.id_user;
				$.get(linkUser, function(data){
					if(!data.error){
						if(data.data.email_verified == 'false') {
							$('#linkInvestor').html('Sewakan Barang');
						} else {
							$('#linkInvestor').html('Toko Saya');
						}
					}
				})

				$('#linkInvestor').on('click', function(){
					var linkURL = "{{ env('APP_API') }}/api/store/addStore.php";
					$.post(linkURL, {id_user: user.id_user}, function(data){
						console.log(data);
						if(!data.error) {
							var linkURLRedirect = "{{ env('APP_API') }}/api/store/userStore.php";
							$.post(linkURLRedirect, {id_user: user.id_user}, function(data) {
								var linkRedirect = "{{ route('rent-product') }}?id="+data.id_store;
								window.location.href = linkRedirect;
							})
						}
					})
				})
			}
		})
	</script>
@endsection