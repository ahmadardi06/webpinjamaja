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
            <span id="priceItem">loading...</span>
        </div>
    </div>
    <div class="product-store item-margin">
        <div class="store-pic">
            <img id="imgStore" src="{{ asset('tema/img/img1.jpg') }}" alt="Store">
        </div>
        <div class="store-name">
            <span id="nameStore">loading...</span>
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
                <span>Nike</span>
            </div>
            <div class="spec">
                <img src="{{ asset('tema/img/sent.png') }}" alt="">
                <span>Bisa Dikirim</span>
            </div>
            <div class="spec">
                <img src="{{ asset('tema/img/color.png') }}" alt="">
                <span>Putih</span>
            </div>
            <div class="spec">
                <img src="{{ asset('tema/img/size.png') }}" alt="">
                <span>114 cm</span>
            </div>
        </div>
    </div>
    <a href="{{ route('form-order') }}" class="btn btn-red btn-danger">Order Sekarang</a>
</div>
@endsection

@section('js')
    <script>
        var urlParams = new URLSearchParams(window.location.search);
        var myParam = urlParams.get('id');

        function formatRP(data) {
            return 'Rp'+parseInt(data).toLocaleString(); 
        }

        $(function(){
            var urlOrigin = window.location.origin;

            var linkURL = urlOrigin+"/database/item.json";
            $.get(linkURL, function(data) {
                $('#imgItem').attr('src', data.img_item)
                $('#nameItem').html(data.item_name)
                $('#priceItem').html(formatRP(data.price) + ' / hari')
                $('#descriptionItem').html(data.description)

                $('#imgStore').attr('src', data.store.img_store)
                $('#nameStore').html(data.store.store_name)
                $('#addressStore').html(data.store.address)
            })
        })
    </script>
@endsection