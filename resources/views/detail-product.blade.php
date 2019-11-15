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
    <hr>
    <div style="margin: 3px; padding: 3px;">
        <div class="text-left">
            <h6 style="font-weight: bold;">Item pada toko yang sama</h6>
        </div>
        <div id="listItems" class="text-left">
            <span>loading...</span>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        var urlParams = new URLSearchParams(window.location.search);
        var myParam = urlParams.get('id');
        var urlOrigin = window.location.origin;
        var storeId;

        function formatRP(data) {
            return 'Rp'+parseInt(data).toLocaleString(); 
        }

        function renderListDOM(data) {
            var price = 'Rp'+parseInt(data.price_day).toLocaleString()+'/hari'; 
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

        $(function(){
            $('#orderItem').attr('href', $('#orderItem').attr('href')+'?id='+myParam);

            // var linkURL = urlOrigin+"/database/item.json";
            var linkURL = "{{ env('APP_API') }}/api/item/itemDetail.php";
            var priceHtml = '';
            $.post(linkURL, {id_item: myParam}, function(data) {
                $('#imgItem').attr('src', data.img_item)
                $('#nameItem').html(data.item_name)
                if(data.price_hour != 0) priceHtml += formatRP(data.price_hour)+'/Hour<br>';
                if(data.price_day != 0) priceHtml += formatRP(data.price_day)+'/Day<br>';
                if(data.price_week != 0) priceHtml += formatRP(data.price_week)+'/Week<br>';
                if(data.price_month != 0) priceHtml += formatRP(data.price_month)+'/Month';
                $('#priceItem').html(priceHtml)
                $('#descriptionItem').html(data.description)
                
                $('#merkItem').html('Merk '+data.merk)
                $('#itemStatusItem').html(data.delivery)
                if(data.selling == 'Ya') {
                    $('#colorItem').html('Bisa Dibeli');
                } else {
                    $('#colorItem').html('Tidak Dibeli');
                }
                $('#sizeItem').html('Sisa Stock '+data.stock)
                
                $('#linkInvestor').attr('href', $('#linkInvestor').attr('href')+'?id='+data.store.id_store)

                $('#imgStore').attr('src', data.store.img_store)
                $('#nameStore').html(data.store.store_name)
                $('#addressStore').html(data.store.address)

                var linkURLItems = "{{ env('APP_API') }}/api/store/readItemStore.php";
                $.post(linkURLItems, {id_store: data.store.id_store}, function(data) {
                    if(!data.error) {
                        var html = '';
                        for(var i=0; i<data.items.length; i++) {
                            if(i < 3) {
                                html += renderListDOM(data.items[i]);
                            }
                        }
                        $('#listItems').html(html);
                    }
                })
            })

        })
    </script>
@endsection