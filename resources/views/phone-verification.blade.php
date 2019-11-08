@extends('layouts.app')

@section('css')
	<link rel="stylesheet" href="{{ asset('tema/css/phone-verification.css') }}">
@endsection

@section('content')
<div class="container">
	<div class="form">
    <!-- <form action="{{ route('phone-verification') }}" class="form"> -->
        <div class="form-group">
            <label>Mohon Lengkapi dengan nomor telepon yang aktif digunakan</label>
            <input id="txtPhone" type="text" class="form-control" placeholder="Nomor Telepon">
        </div>
        <a href="{{ route('account-verification') }}" style="padding: 8px; margin-right: 20px;" class="btn btn-danger btn-list">Batal</a>
        <button id="btnVerifikasi" type="button" class="btn btn-primary btn-list">Verifikasi</button>
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
        <p>Periksa kotak masuk SMS anda untuk melihat token OTP verifikasi nomor telepon.</p>
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
	    var popUpModal = true;

	    var randomFixedInteger = function (length) {
	        return Math.floor(Math.pow(10, length-1) + Math.random() * (Math.pow(10, length) - Math.pow(10, length-1) - 1));
	    }

		$(function(){
			var userInfo = localStorage.getItem('user');
	    	var user = JSON.parse(userInfo);

	    	if(userInfo == null) {
		        window.location.href = "{{ route('login') }}";
		    } else {
		    	var linkURLUser = "{{ env('APP_API') }}/api/user/userDetail.php";
		    	$.post(linkURLUser, {id_user: user.id_user}, function(data){
		    		$('#txtPhone').val(data.phone);
		    	})
		    }

		    $('#btnVerifikasi').on('click', function(){
                var token = randomFixedInteger(6);
                var linkURL = "{{ route('verifikasi-phone') }}";
                var formData = { 
                    token: token, 
                    phone: $('#txtPhone').val(), 
                    _token: '{{ csrf_token() }}' 
                };
                if(!popUpModal) {
                    $.post(linkURL, formData, function(data) {
                        console.log('Token terkirim.');
                    });
                    popUpModal = true;
                    localStorage.setItem('tokenPhone', token);
                }
		    	$('#myModal').modal('show');

		    	$('#btnConfirm').on('click', function(){
		    		var tokenOTP = $('#tokenVerifikasi').val();
		    		if(tokenOTP == '') {
		    			$('#msgVerfikasi').html('Required');
		    			$('#tokenVerifikasi').focus();
		    		} else {
		    			if(tokenOTP == localStorage.getItem('tokenPhone')) {
                            $('#msgVerfikasi').html('Phone successfully verified.').attr('style', 'color: green;');
                        } else {
                            $('#msgVerfikasi').html('Token mismatch!').attr('style', 'color: red;');
                        }
		    		}
		    	})
		    })
	  	})
	</script>
@endsection