@extends('layouts.app')

@section('css')
	<link rel="stylesheet" href="{{ asset('tema/css/email-verification.css') }}">
@endsection

@section('content')
<div class="container">
    <!-- <form action="{{ route('email-verification') }}" class="form"> -->
	<div class="form">
        <div class="form-group">
            <label>Mohon Lengkapi dengan alamat email yang aktif</label>
            <input id="txtEmail" type="email" class="form-control" placeholder="Email">
        </div>
        <a href="{{ route('account-verification') }}" style="padding: 8px; margin-right: 20px;" class="btn btn-danger btn-list">Batal</a>
        <button type="button" id="btnVerifikasi" class="btn btn-primary btn-list" style="padding: 8px; width: 25%">Verifikasi</button>
    <!-- </form> -->
	</div>
</div>

<div class="modal" id="myModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Verifikasi</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p>Periksa kotak masuk email anda untuk melihat token OTP verifikasi email.</p>
        <label>Token OTP</label>
        <input type="text" name="tokenVerifikasi" id="tokenVerifikasi" placeholder="token" class="form-control">
        <span style="color: red;" id="msgVerfikasi"></span>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button id="btnConfirm" type="button" class="btn btn-success">Confirm</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
@endsection

@section('js')
	<script>
		var linkOrigin = window.location.origin;
        var popUpModal = false;

        var randomFixedInteger = function (length) {
            return Math.floor(Math.pow(10, length-1) + Math.random() * (Math.pow(10, length) - Math.pow(10, length-1) - 1));
        }

		$(function(){
			var userInfo = localStorage.getItem('user');
		    var user = JSON.parse(userInfo);
		    if(userInfo == null) {
		        window.location.href = "{{ route('login') }}";
		    } else {
		    	$('#txtEmail').val(user.email);
		    }

		    $('#btnVerifikasi').on('click', function(){
                var token = randomFixedInteger(6);
                var linkURL = "{{ route('message') }}";
                var formData = { 
                    token: token, 
                    name: user.name, 
                    email: user.email, 
                    _token: '{{ csrf_token() }}' 
                };
                if(!popUpModal) {
                    $.post(linkURL, formData, function(data) {
                        console.log('Email terkirim.');
                        localStorage.setItem('tokenEmail', token);
                        popUpModal = true;
                    });
                }
		    	$('#myModal').modal('show');

		    	$('#btnConfirm').on('click', function(){
		    		var tokenOTP = $('#tokenVerifikasi').val();
		    		if(tokenOTP == '') {
		    			$('#msgVerfikasi').html('Required');
		    			$('#tokenVerifikasi').focus();
		    		} else {
		    			if(tokenOTP == localStorage.getItem('tokenEmail')) {
                            $('#msgVerfikasi').html('Email successfully verified.').attr('style', 'color: green;');
                        } else {
                            $('#msgVerfikasi').html('Token mismatch!').attr('style', 'color: red;');
                        }
		    		}
		    	})
		    })
		})
	</script>
@endsection