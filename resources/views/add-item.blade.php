@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('tema/css/add-item.css') }}">
@endsection

@section('content')
<div class="container">
    <h4>Tambah Barang</h4>
    <hr>
    <div class="item-margin">
        <form action="{{ route('rent-product') }}">
            @csrf
            <div class="form-group" style="text-align: left; font-size: 18px;">
                <label>Pilih Gambar</label>
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="customFile" name="foto-kartu">
                    <label class="custom-file-label" for="customFile">Pilih File</label>
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/product-name.png') }}" alt="Nama Produk">
                </div>
                <div class="input-text">
                    <input type="text" class="form-group" placeholder="Max. 80 Karakter">
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/product-desc.png') }}" alt="Deskripsi Produk">
                </div>
                <div class="input-text">
                    <input type="text" class="form-group" placeholder="Deskripsi Produk">
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/merk.png') }}" alt="Merek Produk">
                </div>
                <div class="input-text">
                    <input type="text" class="form-group" placeholder="Merek">
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
                    <input id="form_price_jam" type="text" class="form-group" name="price_jam" placeholder="Harga per jam" style="margin-left: 24px;" hidden="hidden">
                    <div class="custom-control custom-checkbox mb-3" style="margin-left: 24px;">
                        <input type="checkbox" class="custom-control-input" id="price_hari" onclick="priceHari(this)">
                        <label class="custom-control-label" for="price_hari">Hari</label>
                    </div>
                    <input id="form_price_hari" type="text" class="form-group" name="price_hari" placeholder="Harga per hari" style="margin-left: 24px;" hidden="hidden">
                    <div class="custom-control custom-checkbox mb-3" style="margin-left: 24px;">
                        <input type="checkbox" class="custom-control-input" id="price_minggu" onclick="priceMinggu(this)">
                        <label class="custom-control-label" for="price_minggu">Minggu</label>
                    </div>
                    <input id="form_price_minggu" type="text" class="form-group" name="price_minggu" placeholder="Harga per minggu" style="margin-left: 24px;" hidden="hidden">
                    <div class="custom-control custom-checkbox mb-3" style="margin-left: 24px;">
                        <input type="checkbox" class="custom-control-input" id="price_bulan" onclick="priceBulan(this)">
                        <label class="custom-control-label" name="price_bulan" for="price_bulan">Bulan</label>
                    </div>
                    <input id="form_price_bulan" type="text" class="form-group" placeholder="Harga per bulan" style="margin-left: 24px;" hidden="hidden">
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/stock.png') }}" alt="Stock Produk">
                </div>
                <div class="input-text">
                    <input type="text" class="form-group" placeholder="Stock">
                </div>
            </div>

            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/category.png') }}" alt="Category">
                </div>
                <div class="input-text">
                    <select name="category" class="custom-select mb-3">
                        <option disabled value="Olahraga" selected>Pilih Kategori</option>
                        <option value="Olahraga">Olahraga</option>
                        <option value="Fotografi">Fotografi</option>
                        <option value="Hiking">Hiking</option>
                        <option value="Sepeda">Sepeda</option>
                        <option value="Alat Musik">Alat Musik</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
            </div>
            <div class="input-item">            
                <div class="input-icon">
                    <img src="{{ asset('tema/img/condition.png') }}" alt="Stock Produk">
                </div>
                <div class="input-text" style="text-align: left;">
                    <span style="margin-left: 24px;">Bisa Dibeli</span><br>  
                    <div class="custom-control custom-radio" style="margin-left: 24px;">
                        <input type="radio" class="custom-control-input" id="iya" name="bisa-dibeli">
                        <label class="custom-control-label" for="iya">Iya</label>
                    </div>
                    <div class="custom-control custom-radio" style="margin-left: 24px;">
                        <input type="radio" class="custom-control-input" id="tidak" name="bisa-dibeli">
                        <label class="custom-control-label" for="tidak">Tidak</label>
                    </div>
                </div><br>
            </div>

            <div class="input-item">            
                <div class="input-icon">
                    <img src="{{ asset('tema/img/condition.png') }}" alt="Stock Produk">
                </div>
                <div class="input-text" style="text-align: left;">
                    <span style="margin-left: 24px;">Pengiriman</span><br>  
                    <div class="custom-control custom-radio" style="margin-left: 24px;">
                        <input type="radio" class="custom-control-input" id="dikirim" name="pengiriman">
                        <label class="custom-control-label" for="dikirim">Bisa Dikirm</label>
                    </div>
                    <div class="custom-control custom-radio" style="margin-left: 24px;">
                        <input type="radio" class="custom-control-input" id="ditempat" name="pengiriman">
                        <label class="custom-control-label" for="ditempat">Ambil di tempat</label>
                    </div>
                </div><br>
            </div>
            
            <div class="btnbtn">
                <button type='submit' class="btn btn-red btn-danger">Simpan</button>
            </div>            
        </form>
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
</script>
@endsection