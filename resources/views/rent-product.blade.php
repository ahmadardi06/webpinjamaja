@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('tema/css/rent-product.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="product-store">
        <div class="store-pic">
            <img id="imgStore" src="{{ asset('tema/img/img1.jpg') }}" alt="Store">
        </div>
        <div class="store-name">
            <span id="nameStore" style="font-weight: bold; font-size: 16px;">loading...</span><br>
            <span id="emailStore">loading...</span><br>
            <span id="phoneStore">loading...</span>
        </div>
    </div>

    <div id="userLogin">
        
        <div class="product-spec item-margin">
            <div class="specs">
                <a href="{{ route('tracking-order-investor') }}" class="spec click-link">
                    <img src="{{ asset('tema/img/list-order.png') }}" alt="">
                    <span>List-Order</span>
                </a>
                <a href="{{ route('tracking-order-investor') }}" class="spec click-link">
                    <img src="{{ asset('tema/img/dipinjam.png') }}" alt="">
                    <span>Dipinjam</span>
                </a>
                <a href="{{ route('tracking-order-investor') }}" class="spec click-link">
                    <img src="{{ asset('tema/img/batal.png') }}" alt="">
                    <span>Batal</span>
                </a>
                <a href="{{ route('tracking-order-investor') }}" class="spec click-link">
                    <img src="{{ asset('tema/img/selesai.png') }}" alt="">
                    <span>Selesai</span>
                </a>
            </div>
            <hr>
        </div>

        <div class="btn-link">
            <a id="btnEditStore" href="#" class="btn-list">
                <div class="btn-icon">
                    <img src="{{ asset('tema/img/identity-store.png') }}" alt="Identitas Toko">
                </div>
                <div class="btn btn-primary btn-text">
                    Identitas Toko
                    <span style="float: right; color: red; font-weight: bold;">></span>
                </div>
            </a>
            <a href="javascript:;" id="btnMyBank" class="btn-list">
                <div class="btn-icon">
                    <img src="{{ asset('tema/img/faq.png') }}" alt="Identitas Toko">
                </div>
                <div class="btn btn-primary btn-text">
                    Info Bank
                    <span style="float: right; color: red; font-weight: bold;">></span>
                </div>
            </a>
            <a href="{{ route('add-item') }}" id="detailInvestor" class="btn-list">
                <div class="btn-icon">
                    <img src="{{ asset('tema/img/add.png') }}" alt="Identitas Toko">
                </div>
                <div class="btn btn-primary btn-text">
                    Tambah Item
                    <span style="float: right; color: red; font-weight: bold;">></span>
                </div>
            </a>
            <hr>
        </div>

    </div>

    <div class="ready-item item-margin">
        <h6>
            Ready Items
            <a id="storeItem" style="float: right; text-decoration: none;" href="{{ route('rent-product-item') }}">Lihat Semua</a>
        </h6>
        <div class="row text-left" id="listItems" style="margin: 5px;">
            <p class="text-center">loading...</p>
        </div>
    </div>
</div>

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Edit Store</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form">
            <input type="hidden" name="idStore" id="idStore">
            <input type="hidden" name="photoHidden" id="photoHidden">
            <div class="form-group">
                <label class="form-label">Store Name</label>
                <input type="text" name="storeName" id="storeName" placeholder="enter..." class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Address</label>
                <input type="text" name="address" id="address" placeholder="enter..." class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">City</label>
                <input type="text" name="city" id="city" placeholder="enter..." class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Photo</label>
                <input type="file" name="filePicker" onchange="encodeImageFileAsURL(this)" id="filePicker" placeholder="enter..." class="form-control">
            </div>
            <div class="form-group" id="imgPreview">
            </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button id="btnSave" type="button" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal" id="myModalBank">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="titleMyBank">Informasi Bank</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="form">
            <input type="hidden" name="idStore" id="idStore">
            <div class="form-group">
                <label class="form-label">Nama Bank</label>
                <input type="text" name="nameBank" id="nameBank" placeholder="enter..." class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Atas Nama</label>
                <input type="text" name="atasNama" id="atasNama" placeholder="enter..." class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Nomor Rekening</label>
                <input type="text" name="noRekening" id="noRekening" placeholder="enter..." class="form-control">
            </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button id="btnSaveBank" type="button" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
@endsection

@section('js')
    <script>
        var urlParams = new URLSearchParams(window.location.search);
        var myParam = urlParams.get('id');
        var urlOrigin = window.location.origin;
        var userInfo = localStorage.getItem('user');
        var user = JSON.parse(userInfo);

        function formatRP(data) {
            return 'Rp'+parseInt(data).toLocaleString(); 
        }

        function encodeImageFileAsURL(element) {
            var file = element.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                console.log('RESULT', reader.result)
                $('#imgPreview').html('<img src="'+reader.result+'" class="img-thumbnail" width="100px"/>');
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
              $('#photoHidden').val(base64String);
            };
          })(f);
          reader.readAsBinaryString(f);
        }

        function renderDOM(data) {
            var htmlPrice = '';
            if(data.price_hour != 0) { htmlPrice = 'Rp'+parseInt(data.price_hour).toLocaleString()+'/jam'; }
            if(data.price_day != 0) { htmlPrice = 'Rp'+parseInt(data.price_day).toLocaleString()+'/hari'; }
            if(data.price_week != 0) { htmlPrice = 'Rp'+parseInt(data.price_week).toLocaleString()+'/minggu'; }
            if(data.price_month != 0) { htmlPrice = 'Rp'+parseInt(data.price_month).toLocaleString()+'/bulan'; }
            var price = htmlPrice;
            var html = '';
                html += '<div class="item-category list-for-rent">';
                html += '<a href="{{ route('detail-product') }}?id='+data.id_item+'" class="click-link">';
                    html += '<div class="one-list-for-rent">';
                        html += '<figure class="pic-for-rent">';
                            html += '<img src="'+data.img_item+'" class="">';
                        html += '</figure>';
                        html += '<div class="desc-for-rent">';
                            html += '<span class="title-of-rent">'+data.item_name+'</span>';
                            html += '<span style="font-size: 12px;">Stok '+data.stock+'</span>';
                            html += '<span style="font-size: 18px; font-weight: bold">'+price+'</span>';
                            html += '<button class="btn btn-sm btn-primary">Pinjam Sekarang</button>';
                        html += '</div>';
                    html += '</div>';
                html += '</a>';
            html += '</div>';
            return html;
        }

        function renderDOMItems(data) {
            var html = '';
            html += '<div class="col col-6">';
                html += '<a href="{{ route('preview-item') }}" class="thumbnail">';
                    html += '<img src="'+data.img_item+'" alt="Lights" style="width:100%">';
                    html += '<div class="caption">';
                        html += '<a style="text-decoration: none;" href="{{ route('detail-product') }}?id='+data.id_item+'"><p style="margin: 0; font-weight: bold;">'+data.item_name+'</p></a>';
                        html += '<p>'+formatRP(data.price_day)+'</p>';
                    html += '</div>';
                    html += '</a>';
                html += '</a>';
            html += '</div>';
            return html;
        }

        $(function(){
            $('#userLogin').hide();
            $('#btnEditStore').hide();

            $('#storeItem').attr('href', $('#storeItem').attr('href')+'?id='+myParam);

            $('#detailInvestor').attr('href', $('#detailInvestor').attr('href')+'?id='+myParam);

            $('#btnEditStore').on('click', function(){
                $('#myModal').modal('show');

                var linkURL = "{{ env('APP_API') }}/api/store/storeDetail.php";
                $.post(linkURL, {id_store: myParam}, function(data){
                    $('#idStore').val(data.id_store);
                    $('#storeName').val(data.store_name);
                    $('#address').val(data.address);
                    $('#city').val(data.city);
                    $('#photo').val(data.img_store);
                })
            })
            
            $('#btnSave').on('click', function(){
                var formData = { 
                    id_store: $('#idStore').val(),
                    store_name: $('#storeName').val(),
                    address: $('#address').val(),
                    city: $('#city').val(),
                    img_store: $('#photoHidden').val(),
                };

                var linkURLEdit = "{{ env('APP_API') }}/api/store/editStore.php";
                $.post(linkURLEdit, formData, function(data){
                    window.location.reload();
                })
            })

            $('#btnMyBank').on('click', function(){
                $('#myModalBank').modal('show');
            })

            $('#btnSaveBank').on('click', function(){
                var formData = {
                    bank_name: $('#nameBank').val(),
                    name: $('#atasNama').val(),
                    no_rekening: $('#noRekening').val(),
                    id_store: myParam
                };

                if($('#nameBank').val() == "" && $('#atasNama').val() == "" && $('#noRekening').val() == ""){
                    $('#titleMyBank').html('Semua kolom harus terisi.');
                    $('#nameBank').focus();
                } else {
                    var linkBank = "{{ env('APP_API') }}/api/store/bankStore.php";
                    $.post(linkBank, formData, function(data){
                        if(!data.error) {
                            window.location.reload();
                        }
                    })
                }
            })

            var linkURL = "{{ env('APP_API') }}/api/store/storeDetail.php";
            $.post(linkURL, {id_store: myParam}, function(data){
                if(data.fk_user == user.id_user) {
                    $('#userLogin').show();
                    $('#btnEditStore').show();
                } else {
                    $('#btnEditStore').hide();
                    $('#userLogin').hide();
                }
            })

            $.post(linkURL, {id_store: myParam}, function(data){
                $('#imgStore').attr('src', data.img_store);
                $('#nameStore').html(data.store_name);
                $('#phoneStore').html(data.city);
                $('#emailStore').html(data.address);
            })

            var linkURLBank = "{{ env('APP_API') }}/api/store/readBank.php";
            $.post(linkURLBank, {id_store: myParam}, function(data){
                if(!data.error){
                    $('#atasNama').val(data.data.name);
                    $('#noRekening').val(data.data.no_rekening);
                    $('#nameBank').val(data.data.bank_name);
                }
            })

            var linkURLItems = "{{ env('APP_API') }}/api/store/readItemStore.php?page=2";
            $.post(linkURLItems, {id_store: myParam}, function(data) {
                if(!data.error) {
                    var html = '';
                    for(var i=0; i<data.items.length; i++) {
                        if(i<5){
                            html += renderDOM(data.items[i]);
                        }
                    }
                    $('#listItems').html(html);
                }
            })
        })
    </script>
@endsection