@extends('layouts.app')

@section('content')
<div class="container">
    <div class="product-store">
        <div class="store-pic">
            <img src="{{ asset('tema/img/img1.jpg') }}" alt="Store">
        </div>
        <div class="store-name">
            <span style="font-weight: bold; font-size: 16px;">Rama Store</span><br>
            <span>ramadwiandika@gmail.com</span><br>
            <span>081234567890</span>
        </div>
    </div>
    <div class="product-spec item-margin">
        <div class="specs">
            <a href="{{ route('tracking-order') }}" class="spec click-link">
                <img src="{{ asset('tema/img/list-order.png') }}" alt="">
                <span>List-Order</span>
            </a>
            <a href="{{ route('tracking-order') }}" class="spec click-link">
                <img src="{{ asset('tema/img/dipinjam.png') }}" alt="">
                <span>Dipinjam</span>
            </a>
            <a href="{{ route('tracking-order') }}" class="spec click-link">
                <img src="{{ asset('tema/img/batal.png') }}" alt="">
                <span>Batal</span>
            </a>
            <a href="{{ route('tracking-order') }}" class="spec click-link">
                <img src="{{ asset('tema/img/selesai.png') }}" alt="">
                <span>Selesai</span>
            </a>
        </div>
        <hr>
    </div>

    <div class="btn-link">
        <a href="#" class="btn-list">
            <div class="btn-icon">
                <img src="{{ asset('tema/img/identity-store.png') }}" alt="Identitas Toko">
            </div>
            <div class="btn btn-primary btn-text">
                Identitas Toko
                <span style="float: right; color: red; font-weight: bold;">></span>
            </div>
        </a>
        <a href="#" class="btn-list">
            <div class="btn-icon">
                <img src="{{ asset('tema/img/add.png') }}" alt="Identitas Toko">
            </div>
            <div class="btn btn-primary btn-text">
                Tambah Item
                <span style="float: right; color: red; font-weight: bold;">></span>
            </div>
        </a>
        <a href="#" class="btn-list">
            <div class="btn-icon">
                <img src="{{ asset('tema/img/faq.png') }}" alt="Identitas Toko">
            </div>
            <div class="btn btn-primary btn-text">
                Bantuan
                <span style="float: right; color: red; font-weight: bold;">></span>
            </div>
        </a>
        <hr>
    </div>
    <div class="ready-item item-margin">
        <h6>Ready Items</h6>
        <div class="row">
            <div class="col col-6">
                <a href="#" class="thumbnail">
                    <img src="{{ asset('tema/img/img1.jpg') }}" alt="Lights" style="width:100%">
                    <div class="caption">
                        <p style="margin: 0; font-weight: bold;">Bola Golf</p>
                        <p>Rp. 30.000</p>
                    </div>
                    </a>
                </a>
            </div>
            <div class="col col-6">
                <a href="#" class="thumbnail">
                    <img src="{{ asset('tema/img/img1.jpg') }}" alt="Lights" style="width:100%">
                    <div class="caption">
                        <p style="margin: 0; font-weight: bold;">Bola Golf</p>
                        <p>Rp. 30.000</p>
                    </div>
                    </a>
                </a>
            </div>
            <div class="col col-6">
                <a href="#" class="thumbnail">
                    <img src="{{ asset('tema/img/img1.jpg') }}" alt="Lights" style="width:100%">
                    <div class="caption">
                        <p style="margin: 0; font-weight: bold;">Bola Golf</p>
                        <p>Rp. 30.000</p>
                    </div>
                    </a>
                </a>
            </div>
            <div class="col col-6">
                <a href="#" class="thumbnail">
                    <img src="{{ asset('tema/img/img1.jpg') }}" alt="Lights" style="width:100%">
                    <div class="caption">
                        <p style="margin: 0; font-weight: bold;">Bola Golf</p>
                        <p>Rp. 30.000</p>
                    </div>
                    </a>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection