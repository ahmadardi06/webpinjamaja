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
                <a href="{{ route('tracking-order') }}" class="spec click-link">
                    <img src="{{ asset('tema/img/list-order.png') }}" alt="">
                    <span>List-Order</span>
                </a>
                <a href="{{ route('tracking-order') }}" class="spec click-link">
                    <img src="{{ asset('tema/img/dipinjam.png') }}" alt="">
                    <span>Dipinjam</span>
                </a>
                <a href="{{ route('tracking-order') }}" class="spec click-link">
                    <img src="{{ asset('tema/img/batal.png') }}" alt="">
                    <span>Batal</span>
                </a>
                <a href="{{ route('tracking-order') }}" class="spec click-link">
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
            <a href="{{ route('add-item') }}" id="detailInvestor" class="btn-list">
                <div class="btn-icon">
                    <img src="{{ asset('tema/img/add.png') }}" alt="Identitas Toko">
                </div>
                <div class="btn btn-primary btn-text">
                    Tambah Item
                    <span style="float: right; color: red; font-weight: bold;">></span>
                </div>
            </a>
            <a href="#" class="btn-list">
                <div class="btn-icon">
                    <img src="{{ asset('tema/img/faq.png') }}" alt="Identitas Toko">
                </div>
                <div class="btn btn-primary btn-text">
                    Bantuan
                    <span style="float: right; color: red; font-weight: bold;">></span>
                </div>
            </a>
            <hr>
        </div>

    </div>

    <div class="ready-item item-margin">
        <h6>Ready Items</h6>
        <div class="row" id="listItems">
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
                <input type="text" name="photo" id="photo" placeholder="enter..." class="form-control">
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

                $('#btnSave').on('click', function(){
                    var formData = { 
                        id_store: $('#idStore').val(),
                        store_name: $('#storeName').val(),
                        address: $('#address').val(),
                        city: $('#city').val(),
                        img_store: $('#photo').val(),
                    };

                    var linkURLEdit = "{{ env('APP_API') }}/api/store/editStore.php";
                    $.post(linkURLEdit, formData, function(data){
                        window.location.reload();
                    })
                })
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

            var linkURLItems = "{{ env('APP_API') }}/api/store/readItemStore.php";
            $.post(linkURLItems, {id_store: myParam}, function(data) {
                if(!data.error) {
                    var html = '';
                    for(var i=0; i<data.items.length; i++) {
                        html += renderDOMItems(data.items[i]);
                    }
                    $('#listItems').html(html);
                }
            })
        })
    </script>
@endsection