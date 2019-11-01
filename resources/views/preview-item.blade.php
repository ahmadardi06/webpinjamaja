@extends('layouts.app')

@section('content')
<div class="product-pic">
    <img src="{{ asset('tema/img/img1.jpg') }}">
</div>

<div class="container">
    <div class="product-name">
        <div class="name ">
            <span>Stick Golf</span><br>
        </div>
        <div class="price">
            <span>Rp. 30.000 / hari</span>
        </div>
    </div>
    <div class="product-store item-margin">
        <div class="store-pic">
            <img src="{{ asset('tema/img/img1.jpg') }}" alt="Store">
        </div>
        <div class="store-name">
            <span>Rama Store</span>
        </div>
        <div class="store-address">
            Jl. Ketintang No. 158, Surabaya
        </div>
    </div>
    <div class="product-description item-margin">
        <h6 style="font-weight: bold;">Deskripsi</h6>
        <span>Disewakan stick golf warna putih dengan merk Nike</span>
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
</div>
@endsection