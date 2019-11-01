@extends('layouts.app')

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
                    <input type="text" class="form-group" placeholder="Nama Produk">
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
                    <img src="{{ asset('tema/img/color.png') }}" alt="Warna Produk">
                </div>
                <div class="input-text">
                    <input type="text" class="form-group" placeholder="Warna">
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/price.png') }}" alt="Harga Produk">
                </div>
                <div class="input-text">
                    <input type="text" class="form-group" placeholder="Harga">
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/deposit.png') }}" alt="Deposit Produk">
                </div>
                <div class="input-text">
                    <input type="text" class="form-group" placeholder="Deposit">
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
                    <img src="{{ asset('tema/img/location.png') }}" alt="Nama Kota">
                </div>
                <div class="input-text">
                    <input type="text" class="form-group" placeholder="Nama Kota">
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/location.png') }}" alt="Alamat">
                </div>
                <div class="input-text">
                    <input type="text" class="form-group" placeholder="Alamat">
                </div>
            </div>

            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/category.png') }}" alt="Category">
                </div>
                <div class="input-text">
                    <select name="category" class="custom-select mb-3">
                        <option value="Olahraga" selected>Olahraga</option>
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
                <div class="input-text">
                    <select name="category" class="custom-select mb-3">
                        <option value="Baru" selected>Baru</option>
                        <option value="Bekas">Bekas</option>
                    </select>
                </div>
            </div>
            <div class="input-item">
                <div class="input-icon">
                    <img src="{{ asset('tema/img/sent.png') }}" alt="Stock Produk">
                </div>
                <div class="input-text">
                    <select name="category" class="custom-select mb-3">
                        <option value="Dikirim" selected>Dikirim</option>
                        <option value="Tidak Dikirim">Tidak Dikirim</option>
                    </select>
                </div>
            </div>
            <div class="btnbtn">
                <a href="{{ route('preview-item') }}" class="btn btn-red btn-danger">Preview</a>
                <button type='submit' class="btn btn-red btn-danger">Simpan</button>
            </div>
            
            <hr>
        </form>
    </div>
</div>
@endsection