@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/account-info.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="profile-pic">
        <img id="userPict" src="{{ asset('tema/img/img1.jpg') }}">
    </div>
    <div class="row text-left" style="margin: 0px 0px 15px 0px;">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" accept="image/*">
            <label class="custom-file-label" for="customFile">Choose file</label>
            <input type="hidden" name="imgUser" id="imgUser" value="">
        </div>
    </div>
    <span id="message"></span>
    <!-- <form action="{{ route('account') }}" class="form"> -->
    <div class="form">
        <div class="form-group">
            <input type="hidden" name="id_user" id="id_user">
            <input type="text" class="form-control" id="fullname" placeholder="Nama Lengkap">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="phone" placeholder="No. Telepon">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="address" placeholder="Alamat">
        </div>
        <select class="form-control" name="filterLokasi" id="filterLokasi">
            <option value="">== pilih kota ==</option>
        </select>
        <br>
        <!-- <button type="submit" style="width: 50%; background-color: red;" class="btn  btn-danger">Update</button> -->
        <button id="btnUpdate" type="button" style="width: 50%; background-color: red;" class="btn btn-danger">Edit Toko</button>
        <br>
        <br>
        <a href="{{ route('account') }}" style="margin-left: 20px; text-decoration: none;">kembali</a>
    </div>
    <!-- </form> -->
</div>
@endsection

@section('js')
    <script>
        var linkOrigin = window.location.origin;

        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
          encodeImageFileAsURL(this);
        });

        function encodeImageFileAsURL(element) {
            var file = element.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                console.log('RESULT', reader.result)
                $('#userPict').attr('src', reader.result);
            }
            reader.readAsDataURL(file);
            handleFileSelect(element);
        }

        function handleFileSelect(evt) {
          var f = evt.files[0];
          var reader = new FileReader();
          reader.onload = (function(theFile) {
            return function(e) {
              var binaryData = e.target.result;
              var base64String = window.btoa(binaryData);
              $('#imgUser').val(base64String);
            };
          })(f);
          reader.readAsBinaryString(f);
        }

        $(function(){
            var userInfo = localStorage.getItem('user');
            var user = JSON.parse(userInfo);
            if(userInfo == null) {
                window.location.href = window.location.origin + '/login';
            } else {
                $('#id_user').val(user.id_user)

                var linkURL = "{{ env('APP_API') }}/api/user/userDetail.php";
                $.post(linkURL, {id_user: user.id_user}, function(data){
                    $('#userPict').attr('src', data.img_user)
                    $('#fullname').val(data.full_name)
                    $('#email').val(data.email)
                    $('#phone').val(data.phone)
                    $('#address').val(data.address)
                })
            }

            var linkAPICity = "{{ env('APP_API') }}/api/item/readCity.php";
            $.get(linkAPICity, function(data) {
                var html = '<option value="">== pilih kota ==</option>';
                if(!data.error) {
                    for(var i=0; i<data.city.length; i++) {
                        if(data.city[i].city != null) {
                            html += '<option value="'+data.city[i].city+'">'+data.city[i].city+'</option>';
                        }
                    }
                }
                $('#filterLokasi').html(html);
            })

            $('#btnUpdate').on('click', function(){
                var formData = {
                    id_user: $('#id_user').val(),
                    full_name: $('#fullname').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    address: $('#address').val(),
                    city: $('#filterLokasi').val(),
                    img_user: $('#imgUser').val()
                }

                var linkURL = "{{ env('APP_API') }}/api/user/editUser.php";
                $.post(linkURL, formData, function(data){
                    if(!data.error) {
                        window.location.href = "{{ route('account') }}";
                    }
                    $('#message').html(data.message);
                })
            })
        })
    </script>
@endsection