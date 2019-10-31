@extends('layouts.app')

@section('content')
<div class="container">
        <div class="item-category">
            <a class="per-category">
                <div class="menu category-menu" style="width: 100%;">
                    <div class="menu-icon">
                        <img src="{{ asset('tema/img/sport-icon.png') }}">
                    </div>
                    <div class="menu-text">
                        <span>Olahraga</span>
                    </div>
                </div>
            </a>
            <a class="per-category">
                <div class="menu category-menu" style="width: 100%;">
                    <div class="menu-icon">
                        <img src="{{ asset('tema/img/photography-icon.png') }}">
                    </div>
                    <div class="menu-text">
                        <span>Fotografi</span>
                    </div>
                </div>
            </a>
            <a class="per-category">
                <div class="menu category-menu" style="width: 100%;">
                    <div class="menu-icon">
                        <img src="{{ asset('tema/img/outdoor-icon.png') }}">
                    </div>
                    <div class="menu-text">
                        <span>Outdoor</span>
                    </div>
                </div>
            </a>
            <a class="per-category">
                <div class="menu category-menu" style="width: 100%;">
                    <div class="menu-icon">
                        <img src="{{ asset('tema/img/vehicle-icon.png') }}">
                    </div>
                    <div class="menu-text">
                        <span>Kendaraan</span>
                    </div>
                </div>
            </a>
            <a class="per-category">
                <div class="menu category-menu" style="width: 100%;">
                    <div class="menu-icon">
                        <img src="{{ asset('tema/img/music-icon.png') }}">
                    </div>
                    <div class="menu-text">
                        <span>Musik</span>
                    </div>
                </div>
            </a>
            <a class="per-category">
                <div class="menu category-menu" style="width: 100%;">
                    <div class="menu-icon">
                        <img src="{{ asset('tema/img/others-icon.png') }}">
                    </div>
                    <div class="menu-text">
                        <span>Lainnya</span>
                    </div>
                </div>
            </a>
        </div>       
        
        
        <div class="item-category for-carousel">
            <div id="demo" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                </ul>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('tema/img/img3.jpg') }}" alt="img1">  
                        <div class="carousel-caption">
                            <h3>Stik Golf</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('tema/img/img3.jpg') }}" alt="img2">  
                        <div class="carousel-caption">
                            <h3>Barang Kedua</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('tema/img/img3.jpg') }}" alt="img2">  
                        <div class="carousel-caption">
                            <h3>Barang Ketiga</h3>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>  


        <div class="item-category list-for-rent">
            <a href="#" class="click-link">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="title-of-rent">Stik Golf Harga Murah daerah Surabaya</span>
                        <span style="font-size: 12px;">Rama Store1</span>
                        <span style="font-size: 18px; font-weight: bold">Rp. 30.000</span>
                        <button class="btn btn-sm btn-primary">Pinjam Sekarang</button>
                    </div>
                </div>
            </a>
        </div>

        <div class="item-category list-for-rent">
            <a href="#" class="click-link">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="title-of-rent">Stik Golf</span>
                        <span style="font-size: 12px;">Rama Store1</span>
                        <span style="font-size: 18px; font-weight: bold">Rp. 30.000</span>
                        <button class="btn btn-sm btn-primary">Pinjam Sekarang</button>
                    </div>
                </div>
            </a>
        </div>

        <div class="item-category list-for-rent">
            <a href="#" class="click-link">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="title-of-rent">Stik Golf</span>
                        <span style="font-size: 12px;">Rama Store1</span>
                        <span style="font-size: 18px; font-weight: bold">Rp. 30.000</span>
                        <button class="btn btn-sm btn-primary">Pinjam Sekarang</button>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
