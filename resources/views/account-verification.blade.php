@extends('layouts.app')

@section('css')
	<link rel="stylesheet" href="{{ asset('tema/css/account-verification.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css">
@endsection

@section('content')
<div class="container">
    <a id="linkEmail" href="{{ route('email-verification') }}" class="btn btn-list">Email</a>
    <a id="linkTelepon" href="{{ route('phone-verification') }}" class="btn btn-list">No. Telepon</a>
    <a id="linkDataDiri" href="{{ route('identity-verification') }}" class="btn btn-list">Indetitas Diri</a>
</div>
@endsection

@section('js')
	<script>
		var userInfo = localStorage.getItem('user');
		var user = JSON.parse(userInfo);

		$(function(){
			if(userInfo == null) {
				window.location.href = "{{ route('login') }}";
			} else {
				var linkUser = "{{ env('APP_API') }}/api/baskets/updateverifikasi.php?id_user="+user.id_user;
				$.get(linkUser, function(data){
					if(!data.error){
						if(data.data.email_verified == 'false') {
							$('#linkEmail').html('Verifikasi Email Sekarang');
						} else {
							$('#linkEmail').html('Email Terverifikasi');
						}

						if(data.data.telp_verified == 'no') {
							$('#linkTelepon').html('Verifikasi Telepon Sekarang');
						} else {
							$('#linkTelepon').html('Telepon Terverifikasi');
						}
					}
				})
			}
		})
	</script>
@endsection