<?php
$products = Session::get('products');
// dd($products);
// dd($products['img_item']);
// $id = $products['item_id'];
$id = '42';
$price = $products['price'];
$priceString = number_format($price);
// dd($priceString);
?>
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/form-order.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
@endsection

@section('content')
<div class="product-pic">
    <img id="imgItem" src="{{ asset('tema/img/img1.jpg') }}">
    <!-- <img src="{{ $products['img_item'] }}"> -->
</div>

<div class="container">
<form action="{{ route('payment-now') }}" method="POST">
    @csrf
    <input name="id_item" value="{{ $id }}" hidden>
    <div class="product-name">
        <div class="name ">
            <span id="nameItem">loading...</span><br>
            <span id="priceItem" style="color: red;">loading...</span>
        <!-- <div class="name"> -->
            <!-- <span>{{ $products['item_name'] }}</span><br> -->
            <!-- <span style="color: red;">Rp. {{ $priceString }} / hari</span> -->
        </div>
        <a href="#">
            <div class="chat-button">
                <img src="{{ asset('tema/img/chat.png') }}" alt=""><br>
                <span>Tanya Penjual</span>
            </div>
        </a>
    </div>

    <div class="form item-margin">
            <div class="align-left">
                <label>Tanggal Pinjam</label>
                <!-- <input type="text" name="tgl-pinjam" class="form-control tgl" id="tglPinjam"><br> -->

                <!-- <label>Tanggal Kembali</label> -->
                <!-- <input type="text" name="tgl-pinjam" class="form-control tgl" id="tglKembali"><br> -->
                <input type="text" name="date_start" onchange="date_of_rent()" id="date_start" class="form-control tgl"><br>

                <label>Tanggal Kembali</label>
                <input type="text" name="date_end" onchange="date_of_rent()" id="date_end" class="form-control tgl"><br>

                <label>Jumlah</label><br>
                <a class="btn btn-default btn-min" id="min" onclick="kurangi()">-</a>
                <input type="text" id="jml" name="ammount" class="form-control jml" value="1" onchange="hitung_jml()">
                <a class="btn btn-default btn-plus" id="plus" onclick="tambahi()">+</a><br><br>

                <label>Opsi Pengiriman</label>
                <select name="pengiriman" class="custom-select mb-3">
                    <option selected disabled>Opsi Pengiriman</option>
                    <option value="Ambil Sendiri">Ambil Sendiri</option>
                    <option value="Diantar">Diantar</option>
                </select>
                <hr>
                <div class="total-price item-margin">
                    <div class="price-desc">
                        <span>Harga Sewa x <span id="jml_hari">1</span> hari</span><br>
                        <span>Jumlah Barang <span id="jml_item">1</span> item</span>
                    </div>
                    <div class="price">
                        <span>Rp. <span id="harga_xhari">{{ $priceString }}</span></span><br>
                        <span>x <span id="xjml">1</span></span>
                    </div><hr>
                    <div class="price-desc">
                        <span>Total<br>
                    </div>
                    <div class="price">
                        <span style="color: red; font-weight: bold;">Rp. <span id="total_price">{{ $priceString }}</span></span><br>
                        <input name="total" id="total" value="{{ $price }}" hidden="hidden">
                    </div>
                </div>
            </div>
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
            <br>
            <button type="submit" id="submit" class="btn btn-red btn-danger">Lanjut Pembayaran</button>
    </div>
</form>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    // var urlParams = new URLSearchParams(window.location.search);
    // var myParam = urlParams.get('id');

    // function formatRP(data) {
    //     return 'Rp'+parseInt(data).toLocaleString(); 
    // }
    
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    $(function() {
        $('.tgl').datepicker({
            format: 'mm-dd-yyyy'
        }).on('hide', function(event) {
            event.preventDefault();
            event.stopPropagation();
        });
    })

    //     var linkURL = "{{ env('APP_API') }}/api/item/itemDetail.php";
    //     $.post(linkURL, {id_item: myParam}, function(data) {
    //         $('#imgItem').attr('src', data.img_item)
    //         $('#nameItem').html(data.item_name)
    //         $('#priceItem').html(formatRP(data.price) + ' / hari')
    //     })
    // })   

    function tambahi(){
        var jml = document.getElementById('jml').value;
        jml = parseInt(jml);

        jml++;
        document.getElementById('jml').value = jml;
        hitung_jml();
    }

    function kurangi(){
        var jml = document.getElementById('jml').value;
        jml = parseInt(jml);
        
        if(jml < 2){
            jml = 1;
            document.getElementById('jml').value = 1;
        } else{
            jml--;
            document.getElementById('jml').value = jml;
        }
        hitung_jml();
    }

    function countDays(){
        var date_start = document.getElementById('date_start').value;
        var date_end = document.getElementById('date_end').value;

        var date1 = new Date(date_start); 
        var date2 = new Date(date_end); 
        
        var Difference_In_Time = date2.getTime() - date1.getTime(); 
        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

        return Difference_In_Days;
    }

    function totalPrice(){
        var jml_item = document.getElementById('jml').value;
        var jml_hari = countDays();

        var price = '{{ $price }}';

        var total_price = price * jml_item * jml_hari;
        var total_price_string = formatNumber(total_price);

        document.getElementById("total_price").innerHTML = total_price_string;
        $("#total").val(total_price);

    }

    function date_of_rent(){
        var Difference_In_Days = countDays() ;
        
        document.getElementById("jml_hari").innerHTML = Difference_In_Days;

        var price = {{ $price }};    

        var harga_xhari = Difference_In_Days * price;

        var priceString = formatNumber(harga_xhari);

        document.getElementById("harga_xhari").innerHTML = priceString;
        document.getElementById("total_price").innerHTML = priceString;

        totalPrice();
    }

    function hitung_jml(){
        var jml_item = document.getElementById('jml').value;
        
        document.getElementById("jml_item").innerHTML = jml_item;
        document.getElementById("xjml").innerHTML = jml_item;

        totalPrice();
    }


    $(document).ready(function(){
        $.ajax({
            method: "GET",
            url: "http://localhost:8000/api/detilItem",
            data: { id_item: "{{ $id }}" }
        })
        .done(function( items ) {
            var result = JSON.parse(items);
            $("#submit").click(function(){
                $.ajax({
                    method: "POST",
                    url: "http://194.31.53.14/pinjem/api/transaction/user/order.php",
                    data: { 

                    }
                });
            });
        });
    });
</script>
@endsection