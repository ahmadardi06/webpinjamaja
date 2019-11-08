<?php
$id = $_GET['id'];
?>
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/detail-product.css') }}">
@endsection

@section('content')
<div class="product-pic">
    <img id="imgItem" src="{{ asset('tema/img/img1.jpg') }}">
</div>

<div class="container">
    <div class="product-name">
        <div class="name ">
            <span id="nameItem">loading...</span><br>
        </div>
        <div class="price">
            <span style="font-size: 12px;" id="priceItem">loading...</span>
        </div>
    </div>
    <div class="product-store item-margin">
        <div class="store-pic">
            <img id="imgStore" src="{{ asset('tema/img/img1.jpg') }}" alt="Store">
        </div>
        <div class="store-name">
            <a id="linkInvestor" href="{{ route('rent-product') }}" style="text-decoration: none;">
                <span id="nameStore">loading...</span>
            </a>
        </div>
        <div id="addressStore" class="store-address">
            loading...
        </div>
    </div>
    <div class="product-description item-margin">
        <h6 style="font-weight: bold;">Deskripsi</h6>
        <span id="descriptionItem">loading...</span>
    </div>
    <div class="product-spec item-margin">
        <h6 style="font-weight: bold;">Spesifikasi</h6>
        <div class="specs">
            <div class="spec">
                <img src="{{ asset('tema/img/merk.png') }}" alt="">
                <span id="merkItem">loading...</span>
            </div>
            <div class="spec">
                <img src="{{ asset('tema/img/sent.png') }}" alt="">
                <span id="itemStatusItem">loading...</span>
            </div>
            <div class="spec">
                <img src="{{ asset('tema/img/color.png') }}" alt="">
                <span id="colorItem">loading...</span>
            </div>
            <div class="spec">
                <img src="{{ asset('tema/img/size.png') }}" alt="">
                <span id="sizeItem">loading...</span>
            </div>
        </div>
    </div>
    <a id="orderItem" href="{{ route('form-order') }}" class="btn btn-red btn-danger">Order Sekarang</a>
</div>
@endsection

@section('js')
    <script>
        var urlParams = new URLSearchParams(window.location.search);
        var myParam = urlParams.get('id');
        var urlOrigin = window.location.origin;

        function formatRP(data) {
            return 'Rp'+parseInt(data).toLocaleString(); 
        }

        $(function(){
            $('#orderItem').attr('href', $('#orderItem').attr('href')+'?id='+myParam);

            // var linkURL = urlOrigin+"/database/item.json";
            var linkURL = "{{ env('APP_API') }}/api/item/itemDetail.php";
            $.post(linkURL, {id_item: myParam}, function(data) {
                $('#imgItem').attr('src', data.img_item)
                $('#nameItem').html(data.item_name)
                var priceHtml = formatRP(data.price_hour)+'/Hour<br>';
                priceHtml += formatRP(data.price_day)+'/Day<br>';
                priceHtml += formatRP(data.price_week)+'/Week<br>';
                priceHtml += formatRP(data.price_month)+'/Month';
                $('#priceItem').html(priceHtml)
                $('#descriptionItem').html(data.description)
                $('#merkItem').html(data.merk)
                $('#sizeItem').html(data.size)
                $('#itemStatusItem').html(data.item_status)
                $('#colorItem').html(data.color)
                $('#linkInvestor').attr('href', $('#linkInvestor').attr('href')+'?id='+data.store.id_store)

                $('#imgStore').attr('src', data.store.img_store)
                $('#nameStore').html(data.store.store_name)
                $('#addressStore').html(data.store.address)
            })
        })
    </script>
@endsection