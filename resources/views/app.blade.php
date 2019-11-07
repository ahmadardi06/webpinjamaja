@extends('layouts.app')

@section('content')
<div class="container">
        <div class="item-category cat">
            <span>Pilih Kategori</span><br><br>
            <a href="{{ route('list-item') }}" class="per-category">
                <div class="menu category-menu" style="width: 100%;">
                    <div class="menu-icon">
                        <img src="{{ asset('asset/category/ic_music.png') }}">
                    </div>
                    <div class="menu-text">
                        <span>Alat Musik</span>
                    </div>
                </div>
            </a>
            <a href="{{ route('list-item') }}" class="per-category">
                <div class="menu category-menu" style="width: 100%;">
                    <div class="menu-icon">
                        <img src="{{ asset('asset/category/ic_soccer.png') }}">
                    </div>
                    <div class="menu-text">
                        <span>Olahraga</span>
                    </div>
                </div>
            </a>
            <a href="{{ route('list-item') }}" class="per-category">
                <div class="menu category-menu" style="width: 100%;">
                    <div class="menu-icon">
                        <img src="{{ asset('asset/category/ic_camera.png') }}">
                    </div>
                    <div class="menu-text">
                        <span>Fotografi</span>
                    </div>
                </div>
            </a>
            <a href="{{ route('list-item') }}" class="per-category">
                <div class="menu category-menu" style="width: 100%;">
                    <div class="menu-icon">
                        <img src="{{ asset('asset/category/ic_hiking.png') }}">
                    </div>
                    <div class="menu-text">
                        <span>Hiking</span>
                    </div>
                </div>
            </a>
            <a href="{{ route('list-item') }}" class="per-category">
                <div class="menu category-menu" style="width: 100%;">
                    <div class="menu-icon">
                        <img src="{{ asset('asset/category/ic_sepeda.png') }}">
                    </div>
                    <div class="menu-text">
                        <span>Musik</span>
                    </div>
                </div>
            </a>
            <a href="{{ route('list-item') }}" class="per-category">
                <div class="menu category-menu" style="width: 100%;">
                    <div class="menu-icon">
                        <img src="{{ asset('asset/category/ic_others.png') }}">
                    </div>
                    <div class="menu-text">
                        <span>Lainnya</span>
                    </div>
                </div>
            </a>
        </div><br>
        
        <div class="item-category for-carousel">
            Item Terbaru<br><br>
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
            <a href="{{ route('detail-product') }}?id=1" class="click-link">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="title-of-rent">Stik Golf Harga Murah daerah Surabaya</span>
                        <span style="font-size: 12px;">Rama Store1</span>
                        <span style="font-size: 18px; font-weight: bold">Rp. 30.000</span>
                        <button class="btn btn-sm btn-danger">Lihat Item</button>
                    </div>
                </div>
            </a>
        </div>

        <div class="item-category list-for-rent">
            <a href="{{ route('detail-product') }}?id=1" class="click-link">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="title-of-rent">Stik Golf</span>
                        <span style="font-size: 12px;">Rama Store1</span>
                        <span style="font-size: 18px; font-weight: bold">Rp. 30.000</span>
                        <button class="btn btn-sm btn-danger">Lihat Item</button>
                    </div>
                </div>
            </a>
        </div>

        <div class="item-category list-for-rent">
            <a href="{{ route('detail-product') }}?id=1" class="click-link">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="title-of-rent">Stik Golf</span>
                        <span style="font-size: 12px;">Rama Store1</span>
                        <span style="font-size: 18px; font-weight: bold">Rp. 30.000</span>
                        <button class="btn btn-sm btn-danger">Lihat Item</button>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
