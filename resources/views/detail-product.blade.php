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
    
    <hr>
    
    <div class="ready-item item-margin" style="text-align: left;">
        <h6 style="font-weight: bold;">Item pada toko yang sama</h6><br>
        <div class="row" id="listItems">
            <p class="text-center">loading...</p>
        </div>
    </div>
</div>
<div class="btn-fixed">
    <div class="row">
        <div class="col-sm-3" style="text-align: center; border-right: solid silver 1px">
            <a href="#">
                <img src="{{ asset('tema/img/chat.png') }}" alt="" style="width: 40px;">
            </a>
        </div>

        <div class="col-sm-9" style="text-align: center;">
            <a id="orderItem" href="{{ route('form-order') }}" class="btn btn-red btn-danger" style=" width: 80%;">Order Sekarang</a>
        </div>
    </div>
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
        });

        function renderDOMItems(data) {
            var html = '';
            html += '<div class="col col-6">';
                html += '<a href="{{ route('preview-item') }}" class="thumbnail">';
                    html += '<img src="'+data.img_item+'" alt="Lights" style="width:100%">';
                    html += '<div class="caption">';
                        html += '<a style="text-decoration: none;" href="{{ route('detail-product') }}?id='+data.id_item+'"><p style="margin: 0; font-weight: bold;">'+data.item_name+'</p></a>';
                        html += '<p>'+formatRP(data.price_hour)+'</p>';
                    html += '</div>';
                    html += '</a>';
                html += '</a>';
            html += '</div>';
            return html;
        }

        $(function(){
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