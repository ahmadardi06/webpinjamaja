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
    <div class="form">
        <input name="id_item" value="{{ $id }}" hidden>
        <input name="idStore" id="idStore" type="hidden">
        <div class="product-name">
            <div class="name ">
                <span id="nameItem">loading...</span><br>
                <span id="priceHourItem" style="font-size: 12px;color: red;">loading...</span><br>
                <span id="priceDayItem" style="font-size: 12px;color: red;">loading...</span><br>
                <span id="priceWeekItem" style="font-size: 12px; color: red;">loading...</span><br>
                <span id="priceMonthItem" style="font-size: 12px;color: red;">loading...</span><br>
            </div>
            <a href="#">
                <div class="chat-button">
                    <img src="{{ asset('tema/img/chat.png') }}" alt=""><br>
                    <span>Tanya Penjual</span>
                </div>
            </a>
        </div>

        <div class="row">
            <div class="form-group" style="margin-left: 20px; margin-top: 10px;">
                <input checked type="radio" class="radioButton" name="radioButton" value="hour"> Hour
                <input type="hidden" name="priceHour" id="priceHour">
                &nbsp;&nbsp;
                <input type="radio" class="radioButton" name="radioButton" value="day"> Day
                <input type="hidden" name="priceDay" id="priceDay">
                &nbsp;&nbsp;
                <input type="radio" class="radioButton" name="radioButton" value="week"> Week
                <input type="hidden" name="priceWeek" id="priceWeek">
                &nbsp;&nbsp;
                <input type="radio" class="radioButton" name="radioButton" value="month"> Month
                <input type="hidden" name="priceMonth" id="priceMonth">
            </div>
        </div>

        <div id="formHour" style="text-align: left;">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Durasi Jam</label>
                <div class="col-sm-9">
                    <input onchange="hitungDurasiJam(this)" type="number" class="form-control" id="durasiJam" value="1" placeholder="Berapa Jam">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Tanggal</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control tgl" id="tanggalPinjamJam" placeholder="Set Tanggal Pinjam">
                </div>
            </div>
        </div>

        <div id="formDay" style="text-align: left;">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Pinjam</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control tgl" id="tglPinjam" placeholder="Set Tanggal Pinjam">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Kembali</label>
                <div class="col-sm-9">
                    <input type="text" onchange="countDays()" class="form-control tgl" id="tglKembali" placeholder="Set Tanggal Kembali">
                </div>
            </div>
        </div>

        <div id="formWeek" style="text-align: left;">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Minggu</label>
                <div class="col-sm-9">
                    <input type="number" onchange="hitungDurasiMinggu(this)" value="1" class="form-control" id="durasiMinggu" placeholder="Berapa Minggu">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Tanggal</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control tgl" id="tanggalPinjamMinggu" placeholder="Set Tanggal Pinjam">
                </div>
            </div>
        </div>

        <div id="formMonth" style="text-align: left;">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Bulan</label>
                <div class="col-sm-9">
                    <input type="number" onchange="hitungDurasiBulan(this)" value="1" class="form-control" id="durasiBulan" placeholder="Berapa Bulan">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-3 col-form-label">Tanggal</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control tgl" id="tanggalPinjamBulan" placeholder="Set Tanggal Pinjam">
                </div>
            </div>
        </div>

        <div class="form-group row" style="text-align: left;">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah</label>
            <div class="col-sm-9">
                <a class="btn btn-default btn-min" id="min" onclick="kurangi()">-</a>
                <input type="text" id="jml" name="ammount" class="form-control jml" value="1" onchange="hitung_jml()">
                <a class="btn btn-default btn-plus" id="plus" onclick="tambahi()">+</a>
            </div>
        </div>

        <div class="form-group row" style="text-align: left;">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Pengiriman</label>
            <div class="col-sm-9">
                <select name="pengiriman" id="pengiriman" class="custom-select mb-3">
                    <option selected disabled>Opsi Pengiriman</option>
                    <option value="Ambil Sendiri">Ambil Sendiri</option>
                    <option value="Diantar">Diantar</option>
                </select>
            </div>
        </div>

        <hr>

        <div class="form item-margin">
            <div class="align-left">
                <div class="total-price">
                    <div class="price-desc">
                        <span>Harga Sewa x <span id="jml_hari">1 Hour</span></span><br>
                        <span>Jumlah Barang</span>
                    </div>
                    <div class="price">
                        <span>Rp<span id="harga_xhari">{{ $priceString }}</span></span><br>
                        <span>x<span id="xjml">1</span></span>
                    </div><hr>
                    <div class="price-desc">
                        <span>Total<br>
                    </div>
                    <div class="price">
                        <span style="color: red; font-weight: bold;">Rp<span id="total_price">{{ $priceString }}</span></span><br>
                        <input name="total" id="total" value="{{ $price }}" hidden="hidden">
                    </div>
                </div>
            </div>

            <div id="btnLanjutPembayaran">
                <button type="button" onclick="btnLanjutPembayaranHour()" class="btn btn-red btn-danger">Lanjut Pembayaran</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    var urlParams = new URLSearchParams(window.location.search);
    var myParam = urlParams.get('id');
    var userInfo = localStorage.getItem('user');
    var user = JSON.parse(userInfo);

    function formatRP(data) {
        return 'Rp'+parseInt(data).toLocaleString(); 
    }
    
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    function hitungDurasiJam(el) {
        var initPrice = eval($('#priceHour').val()) * eval($('#durasiJam').val());
        $('#harga_xhari').html(initPrice);
        $('#jml_hari').html($('#durasiJam').val() + ' Hour')
        var initTotalPrice = eval($('#harga_xhari').html()) * eval($('#xjml').html());
        $('#total_price').html(initTotalPrice);
    }

    function hitungDurasiMinggu(el) {
        var initPrice = eval($('#priceWeek').val()) * eval($('#durasiMinggu').val());
        $('#harga_xhari').html(initPrice);
        $('#jml_hari').html($('#durasiMinggu').val() + ' Week')
        var initTotalPrice = eval($('#harga_xhari').html()) * eval($('#xjml').html());
        $('#total_price').html(initTotalPrice);
    }

    function hitungDurasiBulan(el) {
        var initPrice = eval($('#priceMonth').val()) * eval($('#durasiBulan').val());
        $('#harga_xhari').html(initPrice);
        $('#jml_hari').html($('#durasiBulan').val() + ' Month')
        var initTotalPrice = eval($('#harga_xhari').html()) * eval($('#xjml').html());
        $('#total_price').html(initTotalPrice);
    }

    $(function() {
        $('#formHour').show();
        $('#formDay').hide();
        $('#formWeek').hide();
        $('#formMonth').hide();

        $('.radioButton').on('click', function(){
            var thisValue = $(this).val();
            console.log(thisValue);

            if(thisValue == 'hour') {
                $('#btnLanjutPembayaran').html('<button type="button" onfocus="btnLanjutPembayaranHour()" class="btn btn-red btn-danger">Lanjut Pembayaran</button>');
                $('#xjml').html('1');
                $('#jml_hari').html('1 Hour')
                $('#harga_xhari').html($('#priceHour').val())
                $('#total_price').html($('#priceHour').val())
                $('#formHour').show();
                $('#formDay').hide();
                $('#formWeek').hide();
                $('#formMonth').hide();
            } else if(thisValue == 'day') {
                $('#btnLanjutPembayaran').html('<button type="button" onfocus="btnLanjutPembayaranDay()" class="btn btn-red btn-danger">Lanjut Pembayaran</button>');
                $('#xjml').html('1');
                $('#jml_hari').html('1 Day')
                $('#harga_xhari').html($('#priceDay').val())
                $('#total_price').html($('#priceDay').val())
                $('#formHour').hide();
                $('#formDay').show();
                $('#formWeek').hide();
                $('#formMonth').hide();
            } else if(thisValue == 'week') {
                $('#btnLanjutPembayaran').html('<button type="button" onfocus="btnLanjutPembayaranWeek()" class="btn btn-red btn-danger">Lanjut Pembayaran</button>');
                $('#xjml').html('1');
                $('#jml_hari').html('1 Week')
                $('#harga_xhari').html($('#priceWeek').val())
                $('#total_price').html($('#priceWeek').val())
                $('#formHour').hide();
                $('#formDay').hide();
                $('#formWeek').show();
                $('#formMonth').hide();
            } else {
                $('#btnLanjutPembayaran').html('<button type="button" onfocus="btnLanjutPembayaranMonth()" class="btn btn-red btn-danger">Lanjut Pembayaran</button>');
                $('#xjml').html('1');
                $('#jml_hari').html('1 Month')
                $('#harga_xhari').html($('#priceMonth').val())
                $('#total_price').html($('#priceMonth').val())
                $('#formHour').hide();
                $('#formDay').hide();
                $('#formWeek').hide();
                $('#formMonth').show();
            }
        })

        $('.tgl').datepicker({
            format: 'mm-dd-yyyy'
        }).on('hide', function(event) {
            event.preventDefault();
            event.stopPropagation();
        });

        var linkURL = "{{ env('APP_API') }}/api/item/itemDetail.php";
        $.post(linkURL, {id_item: myParam}, function(data) {
            $('#imgItem').attr('src', data.img_item)
            $('#nameItem').html(data.item_name)
            $('#priceHourItem').html(formatRP(data.price_hour) + '/Hour')
            $('#priceHour').val(data.price_hour)
            $('#priceDayItem').html(formatRP(data.price_day) + '/Day')
            $('#priceDay').val(data.price_day)
            $('#priceWeekItem').html(formatRP(data.price_week) + '/Week')
            $('#priceWeek').val(data.price_week)
            $('#priceMonthItem').html(formatRP(data.price_month) + '/Month')
            $('#priceMonth').val(data.price_month)
            $('#idStore').val(data.store.id_store)

            var initPrice = eval($('#priceHour').val()) * eval($('#durasiJam').val());
            $('#harga_xhari').html(initPrice);
            $('#jml_hari').html($('#durasiJam').val() + ' Hour')
            var initTotalPrice = initPrice * eval($('#xjml').html());
            $('#total_price').html(initTotalPrice);
        })

    })

    function btnLanjutPembayaranHour() {
        var formData = {
            pinjam: 'hour',
            id_user: user.id_user,
            id_item: myParam,
            date_start: convertTglIndo($('#tanggalPinjamJam').val()),
            date_end: convertTglIndo($('#tanggalPinjamJam').val()),
            amount: $('#jml').val(),
            total: $('#total_price').html(),
            delivery: $('#pengiriman').val(),
            id_store: $('#idStore').val(),
            _token: "{{ csrf_token() }}"
        };

        var linkURLPost = "{{ route('payment') }}";
        window.location.href = linkURLPost+'?'+serialize(formData);
    }

    function btnLanjutPembayaranDay() {
        var formData = {
            pinjam: 'day',
            id_user: user.id_user,
            id_item: myParam,
            date_start: convertTglIndo($('#tglPinjam').val()),
            date_end: convertTglIndo($('#tglKembali').val()),
            amount: $('#jml').val(),
            total: $('#total_price').html(),
            delivery: $('#pengiriman').val(),
            id_store: $('#idStore').val(),
            _token: "{{ csrf_token() }}"
        };

        var linkURLPost = "{{ route('payment') }}";
        window.location.href = linkURLPost+'?'+serialize(formData);
    }

    function btnLanjutPembayaranWeek() {
        var formData = {
            pinjam: 'week',
            id_user: user.id_user,
            id_item: myParam,
            date_start: convertTglIndo($('#tanggalPinjamMinggu').val()),
            date_end: convertTglIndo($('#tanggalPinjamMinggu').val()),
            amount: $('#jml').val(),
            total: $('#total_price').html(),
            delivery: $('#pengiriman').val(),
            id_store: $('#idStore').val(),
            _token: "{{ csrf_token() }}"
        };

        var linkURLPost = "{{ route('payment') }}";
        window.location.href = linkURLPost+'?'+serialize(formData);
    }

    function btnLanjutPembayaranMonth() {
        var formData = {
            pinjam: 'month',
            id_user: user.id_user,
            id_item: myParam,
            date_start: convertTglIndo($('#tanggalPinjamBulan').val()),
            date_end: convertTglIndo($('#tanggalPinjamBulan').val()),
            amount: $('#jml').val(),
            total: $('#total_price').html(),
            delivery: $('#pengiriman').val(),
            id_store: $('#idStore').val(),
            _token: "{{ csrf_token() }}"
        };

        var linkURLPost = "{{ route('payment') }}";
        window.location.href = linkURLPost+'?'+serialize(formData);
    }

    function tambahi(){
        var jml = document.getElementById('jml').value;
        jml = parseInt(jml);

        jml++;
        document.getElementById('jml').value = jml;
        $('#xjml').html(jml);
        var initTotalPrice = eval($('#harga_xhari').html()) * eval(jml);
        $('#total_price').html(initTotalPrice);
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
        $('#xjml').html(jml);
        var initTotalPrice = eval($('#harga_xhari').html()) * eval(jml);
        $('#total_price').html(initTotalPrice);
    }

    function countDays(){
        var date_start = document.getElementById('tglPinjam').value;
        var date_end = document.getElementById('tglKembali').value;

        var date1 = new Date(date_start); 
        var date2 = new Date(date_end); 
        
        var Difference_In_Time = date2.getTime() - date1.getTime(); 
        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
        console.log(Difference_In_Days);

        $('#jml_hari').html(Difference_In_Days + ' Day');
        $('#harga_xhari').html(eval(Difference_In_Days) * eval($('#priceDay').val()))

        var initTotalPrice = eval($('#harga_xhari').html()) * eval($('#xjml').html());
        $('#total_price').html(initTotalPrice);

        return Difference_In_Days;
    }

    function convertTglIndo(data) {
        var split = data.split('-');
        return split[1]+'-'+split[0]+'-'+split[2];
    }

    function serialize(obj) {
      var str = [];
      for (var p in obj)
        if (obj.hasOwnProperty(p)) {
          str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
        }
      return str.join("&");
    }

</script>
@endsection