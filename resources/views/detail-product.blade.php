<?php
$id = $_GET['id'];
?>
@extends('layouts.app')

@section('content')
<div class="product-pic">
    <img id="img_item" src="{{ asset('tema/img/img1.jpg') }}">
</div>

<div class="container">
    <div class="product-name">
        <div class="name ">
            <span id="nama_item">-</span><br>
        </div>
        <div class="price">
            <span>Rp. <span id="harga">-</span> / hari</span>
        </div>
    </div>
    <div class="product-store item-margin">
        <div class="store-pic">
        <img id="img_store" src="{{ asset('tema/img/img1.jpg') }}" alt="Store">
        </div>
        <div class="store-name">
            <span id="store_name">-</span>
        </div>
        <div class="store-address">
            <span id="store_address">-</span>, <span id="city_address">-</span>
        </div>
    </div>
    <div class="product-description item-margin">
        <h6 style="font-weight: bold;">Deskripsi</h6>
        <span id="item_desc">-</span>
    </div>
    <div class="product-spec item-margin">
        <h6 style="font-weight: bold;">Spesifikasi</h6>
        <div class="specs">
            <div class="spec">
                <img src="{{ asset('tema/img/merk.png') }}" alt="">
                <span id="merek">-</span>
            </div>
            <div class="spec">
                <img src="{{ asset('tema/img/sent.png') }}" alt="">
                <span id="kirim">-</span>
            </div>
            <div class="spec">
                <img src="{{ asset('tema/img/color.png') }}" alt="">
                <span id="color">-</span>
            </div>
            <div class="spec">
                <img src="{{ asset('tema/img/size.png') }}" alt="">
                <span id="size">-</span>
            </div>
        </div>
    </div>
    <form action="order-now" method="post">
        @csrf
        <input name="item_id" value="{{ $id }}" hidden>
        <input name="item_name" id="a" value="" hidden>
        <input name="price" id="b" value="" hidden>
        <input name="img_store" id="c" value="" hidden>
        <input name="img_item" id="d" value="" hidden>
        <input name="store_name" id="e" value="" hidden>
        <input name="address" id="f" value="" hidden>
        <input name="city" id="g" value="" hidden>
        <input name="description" id="h" value="" hidden>
        <input name="merk" id="i" value="" hidden>
        <input name="delivery" id="j" value="" hidden>
        <input name="color" id="k" value="" hidden>
        <input name="size" id="l" value="" hidden>
        
        <button type="submit" id="button" class="btn btn-red btn-danger">Order Sekarang</button>
    </form>
</div>
@endsection

@section('js')
<script>
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    $(document).ready(function(){
        $("#button").click(function(){
            $.post("order-now/",
            {
                datas: "result"
            });
        });
        $.ajax({
            // method: "GET",
            // url: "https://localhost/freelance/webpinjamaja/public/api/detilItem",
            // data: { id_item: "{{ $id }}" }
            method: "POST",
            url: "http://194.31.53.14/pinjem/api/item/itemDetail.php",
            data: { id_item: "{{ $id }}" }
        })
        .done(function( items ) {                
            var result = JSON.parse(items);
            $("#nama_item").html(result.item_name);
            var price = formatNumber(result.price);
            $("#harga").html(price);
            $("#img_store").attr("src",result.store.img_store);
            $("#img_item").attr("src",result.img_item);
            $("#store_name").html(result.store.store_name);
            $("#store_address").html(result.store.address);
            $("#city_address").html(result.store.city);
            $("#item_desc").html(result.description);
            $("#merek").html(result.merk);
            $("#kirim").html(result.delivery);
            $("#color").html(result.color);
            $("#size").html(result.size);


            $("#a").val(result.item_name);
            $("#b").val(result.price);
            $("#c").val(result.store.img_store);
            $("#d").val(result.img_item);
            $("#e").val(result.store.store_name);
            $("#f").val(result.store.address);
            $("#g").val(result.store.city);
            $("#h").val(result.description);
            $("#i").val(result.merk);
            $("#j").val(result.delivery);
            $("#k").val(result.color);
            $("#l").val(result.size);
        });
    });
    
</script>
@endsection