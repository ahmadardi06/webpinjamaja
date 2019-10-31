@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form item-margin">
        <form action="#" method="POST">
            <div class="align-left">
                <label>Metode Pembayaran</label>
                <select name="cars" class="custom-select mb-3">
                    <option selected>Metode Pembayaran</option>
                    <option value="Link Aja">Link Aja</option>
                    <option value="Bayar Di Tempat">Bayar Di Tempat</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                </select>
                <hr>
                <h5>Daftar Belanja</h5>

                <div class="product-store item-margin">
                    <div class="store-icon">
                        <img src="{{ asset('tema/img/store.png') }}">
                    </div>
                    <div class="store-name">
                        <span>Rama Store</span>
                    </div>
                </div>

                <div class="list-product">
                    <figure class="product-pic">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="product-desc">
                        <span>Stik Golf</span><br>
                        <span>Rp. 30.000 x 1 item</span><br>
                        <span>24-09-2019 s/d 28-09-2019</span>
                    </div>
                </div>
                

                <label>Catatan Tambahan</label>
                <input type="text" name="catatan" class="form-control">

                
                <div class="total-price item-margin">
                    <div class="price-desc">
                        <span>Total yang harus dibayar<br>
                    </div>
                    <div class="price">
                        <span style="color: red; font-weight: bold;">Rp. 180.000</span><br>
                    </div>
                </div>
            </div>
            
            <br>
            <a href="{{ route('after-payment') }}" type="submit" class="btn btn-red btn-danger">Bayar Sekarang</a>
        </form>
    </div>
</div>
@endsection