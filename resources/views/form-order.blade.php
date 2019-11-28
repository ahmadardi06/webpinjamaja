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
            <div class="name">
                <span id="nameItem">loading...</span><br>
                <div id="priceHtml" style="font-size: 12px; color: red;">
                    <span>loading...</span>
                </div>
            </div>
            <a href="#">
                <div class="chat-button">
                    <img src="{{ asset('tema/img/chat.png') }}" alt=""><br>
                    <span>Tanya Penjual</span>
                </div>
            </a>
        </div>

        <div class="row">
            <span id="msgPilihan" style="color: red; margin-left: 20px; margin-top: 8px;"></span>
            <div class="form-group" style="margin-left: 20px; margin-top: 10px;">
                <label id="pilihHour">
                    <input type="radio" class="radioButton" name="radioButton" value="hour"> Jam
                    <input type="hidden" name="priceHour" id="priceHour">
                </label>
                <label id="pilihDay">
                    <input type="radio" class="radioButton" name="radioButton" value="day"> Hari
                    <input type="hidden" name="priceDay" id="priceDay">
                </label>
                <label id="pilihWeek">
                    <input type="radio" class="radioButton" name="radioButton" value="week"> Minggu
                    <input type="hidden" name="priceWeek" id="priceWeek">
                </label>
                <label id="pilihMonth">
                    <input type="radio" class="radioButton" name="radioButton" value="month"> Bulan
                    <input type="hidden" name="priceMonth" id="priceMonth">
                </label>
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

            <!-- <div id="btnLanjutPembayaran">
                <button type="button" id="btnBayarHour" onclick="btnLanjutPembayaranHour()" class="btn btn-red btn-danger">Lanjut Pembayaran</button>
            </div> -->

            <button type="button" id="btnBayarHour" class="btn btn-red btn-danger">Lanjut Pembayaran</button>
            <button type="button" id="btnBayarDay" class="btn btn-red btn-danger">Lanjut Pembayaran</button>
            <button type="button" id="btnBayarWeek" class="btn btn-red btn-danger">Lanjut Pembayaran</button>
            <button type="button" id="btnBayarMonth" class="btn btn-red btn-danger">Lanjut Pembayaran</button>

            <hr>

            <a href="{{ route('payment') }}" class="btn btn-red btn-danger">Lihat Keranjang</a>

        </div>
    </div>
</div>

<div class="modal" id="modalBedaItem">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <p>Item bukan dari store yang sama. Silahkan cek keranjang Anda terlebih dahulu.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
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
    var item = {};

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
        if(userInfo == null) {
            window.location.href = "{{ route('login') }}";
        } else {

            $('#formHour').hide();
            $('#formDay').hide();
            $('#formWeek').hide();
            $('#formMonth').hide();
            
            $('#pilihHour').hide();
            $('#pilihDay').hide();
            $('#pilihWeek').hide();
            $('#pilihMonth').hide();

            $('#btnBayarHour').show();
            $('#btnBayarDay').hide();
            $('#btnBayarWeek').hide();
            $('#btnBayarMonth').hide();

            $('.radioButton').on('click', function(){
                var thisValue = $(this).val();
                console.log(thisValue);

                if(thisValue == 'hour') {
                    $('#xjml').html('1');
                    $('#jml_hari').html('1 Jam')
                    $('#harga_xhari').html($('#priceHour').val())
                    $('#total_price').html($('#priceHour').val())
                    $('#formHour').show();
                    $('#formDay').hide();
                    $('#formWeek').hide();
                    $('#formMonth').hide();

                    $('#btnBayarHour').show();
                    $('#btnBayarDay').hide();
                    $('#btnBayarWeek').hide();
                    $('#btnBayarMonth').hide();
                } else if(thisValue == 'day') {
                    $('#xjml').html('1');
                    $('#jml_hari').html('1 Hari')
                    $('#harga_xhari').html($('#priceDay').val())
                    $('#total_price').html($('#priceDay').val())
                    $('#formHour').hide();
                    $('#formDay').show();
                    $('#formWeek').hide();
                    $('#formMonth').hide();

                    $('#btnBayarHour').hide();
                    $('#btnBayarDay').show();
                    $('#btnBayarWeek').hide();
                    $('#btnBayarMonth').hide();
                } else if(thisValue == 'week') {
                    $('#xjml').html('1');
                    $('#jml_hari').html('1 Minggu')
                    $('#harga_xhari').html($('#priceWeek').val())
                    $('#total_price').html($('#priceWeek').val())
                    $('#formHour').hide();
                    $('#formDay').hide();
                    $('#formWeek').show();
                    $('#formMonth').hide();

                    $('#btnBayarHour').hide();
                    $('#btnBayarDay').hide();
                    $('#btnBayarWeek').show();
                    $('#btnBayarMonth').hide();
                } else {
                    $('#xjml').html('1');
                    $('#jml_hari').html('1 Bulan')
                    $('#harga_xhari').html($('#priceMonth').val())
                    $('#total_price').html($('#priceMonth').val())
                    $('#formHour').hide();
                    $('#formDay').hide();
                    $('#formWeek').hide();
                    $('#formMonth').show();

                    $('#btnBayarHour').hide();
                    $('#btnBayarDay').hide();
                    $('#btnBayarWeek').hide();
                    $('#btnBayarMonth').show();
                }
            })

            $('.tgl').datepicker({
                format: 'mm-dd-yyyy'
            }).on('hide', function(event) {
                event.preventDefault();
                event.stopPropagation();
            });

            var linkURL = "{{ env('APP_API') }}/api/item/itemDetail.php";
            var priceHtml = '';
            $.post(linkURL, {id_item: myParam}, function(data) {
                item = data;

                if(data.price_hour != 0) {
                    priceHtml += formatRP(data.price_hour)+'/Jam<br>';
                    $('#pilihHour').show();
                }
                if(data.price_day != 0) {
                    priceHtml += formatRP(data.price_day)+'/Hari<br>';
                    $('#pilihDay').show();
                }
                if(data.price_week != 0) {
                    priceHtml += formatRP(data.price_week)+'/Minggu<br>';
                    $('#pilihWeek').show();
                }
                if(data.price_month != 0) {
                    priceHtml += formatRP(data.price_month)+'/Bulan';
                    $('#pilihMonth').show();
                }

                $('#priceHtml').html(priceHtml);
                
                $('#imgItem').attr('src', data.img_item);
                $('#nameItem').html(data.item_name);
                $('#priceHour').val(data.price_hour);
                $('#priceDay').val(data.price_day);
                $('#priceWeek').val(data.price_week);
                $('#priceMonth').val(data.price_month);
                $('#idStore').val(data.store.id_store);

                var initPrice = eval($('#priceHour').val()) * eval($('#durasiJam').val());
                $('#harga_xhari').html(initPrice);
                $('#jml_hari').html($('#durasiJam').val() + ' Hour')
                var initTotalPrice = initPrice * eval($('#xjml').html());
                $('#total_price').html(initTotalPrice);
            })

            $('#btnBayarHour').on('click', function() {
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
                    user_id: user.id_user, item_id: myParam,
                    _token: "{{ csrf_token() }}",
                };

                var pilihMethod = $("input[name='radioButton']:checked").val();
                if(pilihMethod) {
                    isSameStore(item.store.id_store, function(result) {
                        if(result){
                            var linkAPICheckout = "{{ env('APP_API') }}/api/baskets/checkout.php";
                            $.post(linkAPICheckout, formData, function(data) {
                                if(!data.error){
                                    window.location.href = "{{ route('payment') }}";
                                }
                            })
                        } else {
                            $('#modalBedaItem').modal('show');
                        }
                    })
                } else {
                    $('#msgPilihan').html('Pilih Durasi Pinjam');
                }
            });

            $('#btnBayarDay').on('click', function() {
                var formData = {
                    pinjam: 'day', id_user: user.id_user, id_item: myParam,
                    date_start: convertTglIndo($('#tglPinjam').val()),
                    date_end: convertTglIndo($('#tglKembali').val()),
                    amount: $('#jml').val(), total: $('#total_price').html(),
                    delivery: $('#pengiriman').val(), id_store: $('#idStore').val(),
                    user_id: user.id_user, item_id: myParam,
                    _token: "{{ csrf_token() }}",
                };

                var pilihMethod = $("input[name='radioButton']:checked").val();
                if(pilihMethod) {
                    isSameStore(item.store.id_store, function(result) {
                        if(result) {
                            var linkAPICheckout = "{{ env('APP_API') }}/api/baskets/checkout.php";
                            $.post(linkAPICheckout, formData, function(data) {
                                console.log(data);
                                if(!data.error){
                                    window.location.href = "{{ route('payment') }}";
                                }
                            })
                        } else {
                            $('#modalBedaItem').modal('show');
                        } 
                    })
                } else {
                    console.log('belum')
                    $('#msgPilihan').html('Pilih Durasi Pinjam');
                }
            });

            $('#btnBayarWeek').on('click', function() {
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
                    user_id: user.id_user, item_id: myParam,
                    _token: "{{ csrf_token() }}",
                };

                var pilihMethod = $("input[name='radioButton']:checked").val();
                if(pilihMethod) {
                    isSameStore(item.store.id_store, function(result) {
                        if(result) {
                            var linkAPICheckout = "{{ env('APP_API') }}/api/baskets/checkout.php";
                            $.post(linkAPICheckout, formData, function(data) {
                                console.log(data);
                                if(!data.error){
                                    window.location.href = "{{ route('payment') }}";
                                }
                            })
                        } else {
                            $('#modalBedaItem').modal('show');
                        }
                    })
                } else {
                    console.log('belum')
                    $('#msgPilihan').html('Pilih Durasi Pinjam');
                }
            });

            $('#btnBayarMonth').on('click', function() {
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
                    user_id: user.id_user, item_id: myParam,
                    _token: "{{ csrf_token() }}",
                };

                var pilihMethod = $("input[name='radioButton']:checked").val();
                if(pilihMethod) {
                    isSameStore(item.store.id_store, function(result) {
                        if(result) {
                            var linkAPICheckout = "{{ env('APP_API') }}/api/baskets/checkout.php";
                            $.post(linkAPICheckout, formData, function(data) {
                                console.log(data);
                                if(!data.error){
                                    window.location.href = "{{ route('payment') }}";
                                }
                            })
                        } else {
                            $('#modalBedaItem').modal('show');
                        }
                    });
                } else {
                    console.log('belum')
                    $('#msgPilihan').html('Pilih Durasi Pinjam');
                }
            });
        }
    })

    function isSameStore(id_store, callback) {
        var linkDetail = "{{ env('APP_API') }}/api/baskets/mybasket.php";
        $.post(linkDetail, {user_id: user.id_user}, function(data){
            var isFirstItem = false;
            if(data.data.length != 0) {
                if(id_store == data.data[0].item.id_store) {
                    isFirstItem = true;
                } else {
                    isFirstItem = false
                }
            } else {
                isFirstItem = true;
            }
            callback(isFirstItem);
        });
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
        return split[2]+'-'+split[0]+'-'+split[1];
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