<?php
$products = Session::get('products');
// dd($products);
// dd($products['img_item']);
$id = $products['item_id'];
$price = $products['price'];
$priceString = number_format($price);
?>
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/payment.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="form item-margin">
        <form action="">
            @csrf
            <div class="align-left">
                <label>Metode Pembayaran</label>
                <select name="payment" class="custom-select mb-3">
                    <option selected disabled>Metode Pembayaran</option>
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
                        <span>{{ $products['store_name'] }}</span>
                    </div>
                </div>

                <div class="list-product">
                    <figure class="product-pic">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="product-desc">
                        <span>{{ $products['item_name'] }}</span><br>
                        <span>Rp. {{ $priceString }} x 1 item</span><br>
                        <span>{{ $products['date_start'] }} s/d {{ $products['date_end'] }}</span>
                    </div>
                </div>
                
                <label>Catatan Tambahan</label>
                <input type="text" name="note" class="form-control">

                <div class="total-price item-margin">
                    <div class="price-desc">
                        <span>Total yang harus dibayar<br>
                    </div>
                    <div class="price">
                        <span style="color: red; font-weight: bold;">Rp. {{ $priceString }}</span><br>
                    </div>
                </div>
            </div>
            
            <br>
            <input name="item_id" value="{{ $id }}" hidden>
            <input name="item_name" id="a" value="{{ $products['item_name'] }}" hidden>
            <input name="price" id="b" value="{{ $products['price'] }}" hidden>
            <input name="img_item" id="d" value="{{ $products['img_item'] }}" hidden>
            <input name="store_name" id="e" value="{{ $products['store_name'] }}" hidden>
            <input name="address" id="f" value="{{ $products['address'] }}" hidden>
            <input name="city" id="g" value="{{ $products['city'] }}" hidden>
            <input name="description" id="h" value="{{ $products['description'] }}" hidden>
            <input name="merk" id="i" value="{{ $products['merk'] }}" hidden>
            <input name="delivery" id="j" value="{{ $products['delivery'] }}" hidden>
            <input name="color" id="k" value="{{ $products['color'] }}" hidden>
            <input name="size" id="l" value="{{ $products['size'] }}" hidden>

            <button id="button" type="submit" class="btn btn-red btn-danger">Bayar Sekarang</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function(){
    $( "form" ).submit(function( event ) {
        var data = $( this ).serializeArray() );
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "http://194.31.53.14/pinjem/api/transaction/user/order.php",
            data: { data }
        })
    });
});
</script>
@endsection