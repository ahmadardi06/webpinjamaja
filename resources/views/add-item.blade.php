@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('tema/css/add-item.css') }}">
@endsection

@section('content')
<div class="container">
    <h4>Tambah Barang</h4>
    <hr>
    <div class="item-margin">
        <!-- <form action="{{ route('rent-product') }}"> -->
        <div class="form">
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/photography-icon.png') }}" alt="Gambar Produk">
                </div>
                <div class="input-text">
                    <input type="file" name="imgItem" id="imgItem" class="form-group" onchange="encodeImageFileAsURL(this)">
                    <input type="hidden" name="imgItemValue" id="imgItemValue" value="">
                    <div id="imgPreview" class="form-group" style="text-align: left; margin-left: 20px;"></div>
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/product-name.png') }}" alt="Nama Produk">
                </div>
                <div class="input-text">
                    <input type="text" id="nameItem" class="form-group" placeholder="Name Max. 80 Karakter">
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/product-desc.png') }}" alt="Deskripsi Produk">
                </div>
                <div class="input-text">
                    <input type="text" id="descriptionItem" class="form-group" placeholder="Deskripsi Produk">
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/merk.png') }}" alt="Merek Produk">
                </div>
                <div class="input-text">
                    <input type="text" id="merkItem" class="form-group" placeholder="Merek">
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/price.png') }}" alt="Harga Produk">
                </div>
                <div class="input-text" style="text-align: left;">
                    <span style="margin-left: 24px;">Harga</span><br><br>
                    <div class="custom-control custom-checkbox mb-3" style="margin-left: 24px;">
                        <input type="checkbox" class="custom-control-input" id="price_jam" onclick="priceJam(this)">
                        <label class="custom-control-label" for="price_jam">Jam</label>
                    </div>
                    <input id="form_price_jam" value="0" type="text" class="form-group" name="price_jam" placeholder="Harga per jam" style="margin-left: 24px;" hidden="hidden">
                    <div class="custom-control custom-checkbox mb-3" style="margin-left: 24px;">
                        <input type="checkbox" class="custom-control-input" id="price_hari" onclick="priceHari(this)">
                        <label class="custom-control-label" for="price_hari">Hari</label>
                    </div>
                    <input id="form_price_hari" value="0" type="text" class="form-group" name="price_hari" placeholder="Harga per hari" style="margin-left: 24px;" hidden="hidden">
                    <div class="custom-control custom-checkbox mb-3" style="margin-left: 24px;">
                        <input type="checkbox" class="custom-control-input" id="price_minggu" onclick="priceMinggu(this)">
                        <label class="custom-control-label" for="price_minggu">Minggu</label>
                    </div>
                    <input id="form_price_minggu" value="0" type="text" class="form-group" name="price_minggu" placeholder="Harga per minggu" style="margin-left: 24px;" hidden="hidden">
                    <div class="custom-control custom-checkbox mb-3" style="margin-left: 24px;">
                        <input type="checkbox" class="custom-control-input" id="price_bulan" onclick="priceBulan(this)">
                        <label class="custom-control-label" name="price_bulan" for="price_bulan">Bulan</label>
                    </div>
                    <input id="form_price_bulan" value="0" type="text" class="form-group" placeholder="Harga per bulan" style="margin-left: 24px;" hidden="hidden">
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/stock.png') }}" alt="Stock Produk">
                </div>
                <div class="input-text">
                    <input type="text" id="stockItem" class="form-group" placeholder="Stock">
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/color.png') }}" alt="Color Produk">
                </div>
                <div class="input-text">
                    <input type="text" id="warnaItem" class="form-group" placeholder="Warna">
                </div>
            </div>

            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/category.png') }}" alt="Category">
                </div>
                <div class="input-text">
                    <select id="categoryItem" name="category" class="custom-select mb-3">
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/others-icon.png') }}" alt="Category">
                </div>
                <div class="input-text">
                    <select id="beliItem" name="kondisi" class="custom-select mb-3">
                        <option value="">== Apakah Bisa Dibeli ==</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/sent.png') }}" alt="Category">
                </div>
                <div class="input-text">
                    <select id="deliveryItem" name="delivery" class="custom-select mb-3">
                        <option value="">== Pilih Pengiriman ==</option>
                        <option value="Bisa Dikirim">Bisa Dikirim</option>
                        <option value="Ambil di Tempat">Ambil di Tempat</option>
                    </select>
                </div>
            </div>
            
            <div class="btnbtn">
                <button type='button' id="btnSimpan" class="btn btn-red btn-danger">Simpan</button>
            </div>            
        </div>            
        <!-- </form> -->
    </div>
</div>
@endsection
    
@section('js')
<script>
    function priceJam(data){
        var price_jam = $(data).attr("checked");

        if (typeof price_jam !== typeof undefined ) {
            $("#form_price_jam").attr('hidden','hidden');
            $(data).removeAttr("checked");
        }else{
            $("#form_price_jam").removeAttr('hidden');
            $(data).attr("checked",'checked');
        }
    }

    function priceHari(data){
        var price_hari = $(data).attr("checked");

        if (typeof price_hari !== typeof undefined ) {
            $("#form_price_hari").attr('hidden','hidden');
            $(data).removeAttr("checked");
        }else{
            $("#form_price_hari").removeAttr('hidden');
            $(data).attr("checked",'checked');
        }
    }

    function priceMinggu(data){
        var price_minggu = $(data).attr("checked");

        if (typeof price_minggu !== typeof undefined ) {
            $("#form_price_minggu").attr('hidden','hidden');
            $(data).removeAttr("checked");
        }else{
            $("#form_price_minggu").removeAttr('hidden');
            $(data).attr("checked",'checked');
        }
    }

    function priceBulan(data){
        var price_bulan = $(data).attr("checked");

        if (typeof price_bulan!== typeof undefined ) {
            $("#form_price_bulan").attr('hidden','hidden');
            $(data).removeAttr("checked");
        }else{
            $("#form_price_bulan").removeAttr('hidden');
            $(data).attr("checked",'checked');
        }
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
          $('#imgItemValue').val(base64String);
        };
      })(f);
      reader.readAsBinaryString(f);
    }

    $(function(){
        var myOrigin = window.location.origin;
        var urlParams = new URLSearchParams(window.location.search);
        var myParam = urlParams.get('id');
        
        var linkURL = "{{ env('APP_API') }}/api/item/category.php";
        $.get(linkURL, function(data) {
            if(!data.error){
                var html = '<option value="">== Pilih Kategori ==</option>';
                for(var i=0; i<data.items.length; i++) {
                    html += '<option value="'+data.items[i].category+'">'+data.items[i].category+'</option>';
                }
                $('#categoryItem').html(html);
            }
        })

        $('#btnSimpan').on('click', function(){
            var kondisiBarang = $('#kondisiBarang');
            var formData = {
                id_store: myParam,
                item_name: $('#nameItem').val(),
                description: $('#descriptionItem').val(),
                category: $('#categoryItem').val(),
                stock: $('#stockItem').val(),
                merk: $('#merkItem').val(),
                img_item: $('#imgItemValue').val(),
                selling: $('#beliItem').val(),
                color: $('#warnaItem').val(),
                delivery: $('#deliveryItem').val(),
                price_hour: $('#form_price_jam').val(),
                price_day: $('#form_price_hari').val(),
                price_week: $('#form_price_minggu').val(),
                price_month: $('#form_price_bulan').val(),
            };

            console.log(formData);

            var linkURL = "{{ env('APP_API') }}/api/item/addItem.php";
            $.post(linkURL, formData, function(data) {
                console.log(data);
                if(!data.error) {
                    window.location.href = myOrigin+'/rent-product?id='+myParam;
                }
            })
        })
    })
</script>
@endsection