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
                    <input type="radio" class="radioButton" name="radioButton" value="hour"> Hour
                    <input type="hidden" name="priceHour" id="priceHour">
                </label>
                <label id="pilihDay">
                    <input type="radio" class="radioButton" name="radioButton" value="day"> Day
                    <input type="hidden" name="priceDay" id="priceDay">
                </label>
                <label id="pilihWeek">
                    <input type="radio" class="radioButton" name="radioButton" value="week"> Week
                    <input type="hidden" name="priceWeek" id="priceWeek">
                </label>
                <label id="pilihMonth">
                    <input type="radio" class="radioButton" name="radioButton" value="month"> Month
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
                    <input type="text" class="form-control tgl" id="tanggalPinjamJam" placeholder="Set Tanggal Pinjam" onchange="cekJadwal()">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Jadwal</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Jam Berapa"  id="jadwalJam">
                </div>
            </div>
        </div>

<div class="modal fade" id="modalJadwal" tabindex="-1" role="dialog" aria-labelledby="modalJadwalTitle"
    aria-hidden="true"  data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card card-default">
                    <div class="card-header">Jadwal</div>
                    <div class="card-body">
                        <div class="align-left">
                            <center>
                                <button class="btn btn-primary">Dipilih</button>
                                <button class="btn btn-secondary">Tersedia</button>
                                <button class="btn btn-danger">Terisi</button>
                            </center>
                            <hr style="border-top: 0px">
                            <button class="btn btn-secondary" id="btnJadwal0" onclick="set(this, 0)"><small>00.00 -<br>01.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal1" onclick="set(this, 1)"><small>01.00 -<br>02.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal2" onclick="set(this, 2)"><small>02.00 -<br>03.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal3" onclick="set(this, 3)"><small>03.00 -<br>04.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal4" onclick="set(this, 4)"><small>04.00 -<br>05.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal5" onclick="set(this, 5)"><small>05.00 -<br>06.00</small></button>
                            <hr style="border-top: 0px">
                            <button class="btn btn-secondary" id="btnJadwal6" onclick="set(this, 6)"><small>06.00 -<br>07.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal7" onclick="set(this, 7)"><small>07.00 -<br>08.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal8" onclick="set(this, 8)"><small>08.00 -<br>09.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal9" onclick="set(this, 9)"><small>09.00 -<br>10.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal10" onclick="set(this, 10)"><small>10.00 -<br>11.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal11" onclick="set(this, 11)"><small>11.00 -<br>12.00</small></button>
                            <hr style="border-top: 0px">
                            <button class="btn btn-secondary" id="btnJadwal12" onclick="set(this, 12)"><small>12.00 -<br>13.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal13" onclick="set(this, 13)"><small>13.00 -<br>14.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal14" onclick="set(this, 14)"><small>14.00 -<br>15.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal15" onclick="set(this, 15)"><small>15.00 -<br>16.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal16" onclick="set(this, 16)"><small>16.00 -<br>17.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal17" onclick="set(this, 17)"><small>17.00 -<br>18.00</small></button>
                            <hr style="border-top: 0px">
                            <button class="btn btn-secondary" id="btnJadwal18" onclick="set(this, 18)"><small>18.00 -<br>19.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal19" onclick="set(this, 19)"><small>19.00 -<br>20.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal20" onclick="set(this, 20)"><small>20.00 -<br>21.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal21" onclick="set(this, 21)"><small>21.00 -<br>22.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal22" onclick="set(this, 22)"><small>22.00 -<br>23.00</small></button>
                            <button class="btn btn-secondary" id="btnJadwal23" onclick="set(this, 23)"><small>23.00 -<br>24.00</small></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="setJam()">Save</button>
            </div> 
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
                <button type="button" id="btnBayarHour" onclick="btnLanjutPembayaranHour()" class="btn btn-red btn-danger">Lanjut Pembayaran</button>
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
        $('#formHour').hide();
        $('#formDay').hide();
        $('#formWeek').hide();
        $('#formMonth').hide();
        
        $('#pilihHour').hide();
        $('#pilihDay').hide();
        $('#pilihWeek').hide();
        $('#pilihMonth').hide();

        $('.radioButton').on('click', function(){
            var thisValue = $(this).val();
            console.log(thisValue);

            if(thisValue == 'hour') {
                $('#btnLanjutPembayaran').html('<button type="button" onmousedown="btnLanjutPembayaranHour()" id="btnBayarHour" class="btn btn-red btn-danger">Lanjut Pembayaran</button>');
                $('#xjml').html('1');
                $('#jml_hari').html('1 Hour')
                $('#harga_xhari').html($('#priceHour').val())
                $('#total_price').html($('#priceHour').val())
                $('#formHour').show();
                $('#formDay').hide();
                $('#formWeek').hide();
                $('#formMonth').hide();
            } else if(thisValue == 'day') {
                $('#btnLanjutPembayaran').html('<button type="button" onmousedown="btnLanjutPembayaranDay()" id="btnBayarDay" class="btn btn-red btn-danger">Lanjut Pembayaran</button>');
                $('#xjml').html('1');
                $('#jml_hari').html('1 Day')
                $('#harga_xhari').html($('#priceDay').val())
                $('#total_price').html($('#priceDay').val())
                $('#formHour').hide();
                $('#formDay').show();
                $('#formWeek').hide();
                $('#formMonth').hide();
            } else if(thisValue == 'week') {
                $('#btnLanjutPembayaran').html('<button type="button" id="btnBayarWeek" class="btn btn-red btn-danger">Lanjut Pembayaran</button>').bind('click', btnLanjutPembayaranWeek);
                $('#xjml').html('1');
                $('#jml_hari').html('1 Week')
                $('#harga_xhari').html($('#priceWeek').val())
                $('#total_price').html($('#priceWeek').val())
                $('#formHour').hide();
                $('#formDay').hide();
                $('#formWeek').show();
                $('#formMonth').hide();
            } else {
                $('#btnLanjutPembayaran').html('<button type="button" id="btnBayarMonth" class="btn btn-red btn-danger">Lanjut Pembayaran</button>').bind('click', btnLanjutPembayaranMonth);
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
        var priceHtml = '';
        $.post(linkURL, {id_item: myParam}, function(data) {
            console.log(data)
            if(data.price_hour != 0) {
                priceHtml += formatRP(data.price_hour)+'/Hour<br>';
                $('#pilihHour').show();
            }
            if(data.price_day != 0) {
                priceHtml += formatRP(data.price_day)+'/Day<br>';
                $('#pilihDay').show();
            }
            if(data.price_week != 0) {
                priceHtml += formatRP(data.price_week)+'/Week<br>';
                $('#pilihWeek').show();
            }
            if(data.price_month != 0) {
                priceHtml += formatRP(data.price_month)+'/Month';
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
    })

    function btnLanjutPembayaranHour() {
        var formData = {
            pinjam: 'hour',
            time_rent: 'jam',
            duration_rent: jamTotal,
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
        console.log(pilihMethod);
        if(pilihMethod) {
            console.log('udah')
            var linkAPICheckout = "{{ env('APP_API') }}/api/baskets/checkout.php";
            $.post(linkAPICheckout, formData, function(data) {
                console.log(data);
                if(!data.error){
                    window.location.href = "{{ route('payment') }}";
                }
            })
        } else {
            console.log('belum')
            $('#msgPilihan').html('Pilih Durasi Pinjam');
        }

    }

    function btnLanjutPembayaranDay() {
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
        console.log(pilihMethod);
        if(pilihMethod) {
            console.log('udah')
            var linkAPICheckout = "{{ env('APP_API') }}/api/baskets/checkout.php";
            $.post(linkAPICheckout, formData, function(data) {
                console.log(data);
                if(!data.error){
                    window.location.href = "{{ route('payment') }}";
                }
            })
        } else {
            console.log('belum')
            $('#msgPilihan').html('Pilih Durasi Pinjam');
        }

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
            user_id: user.id_user, item_id: myParam,
            _token: "{{ csrf_token() }}",
        };

        var pilihMethod = $("input[name='radioButton']:checked").val();
        console.log(pilihMethod);
        if(pilihMethod) {
            console.log('udah')
            var linkAPICheckout = "{{ env('APP_API') }}/api/baskets/checkout.php";
            $.post(linkAPICheckout, formData, function(data) {
                console.log(data);
                if(!data.error){
                    window.location.href = "{{ route('payment') }}";
                }
            })
        } else {
            console.log('belum')
            $('#msgPilihan').html('Pilih Durasi Pinjam');
        }

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
            user_id: user.id_user, item_id: myParam,
            _token: "{{ csrf_token() }}",
        };

        var pilihMethod = $("input[name='radioButton']:checked").val();
        console.log(pilihMethod);
        if(pilihMethod) {
            console.log('udah')
            var linkAPICheckout = "{{ env('APP_API') }}/api/baskets/checkout.php";
            $.post(linkAPICheckout, formData, function(data) {
                console.log(data);
                if(!data.error){
                    window.location.href = "{{ route('payment') }}";
                }
            })
        } else {
            console.log('belum')
            $('#msgPilihan').html('Pilih Durasi Pinjam');
        }

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

<script type="text/javascript">
    jamValue = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    function set(btn, jam) {
        if(jamValue[jam] == 0){
            jamValue[jam] = 1;
            // btn.style.backgroundColor = '#007bff';
            $(btn).removeClass("btn-secondary");
            $(btn).addClass("btn-primary");
        } else {
            jamValue[jam] = 0;
            // btn.style.backgroundColor = 'grey';
            $(btn).removeClass("btn-primary");
            $(btn).addClass("btn-secondary");
        }
    }
    function setJam() {
        jamTotal = '';
        durasi = 0;
        for (var i = 0; i < jamValue.length; i++) {
            if(jamValue[i] == 1) {
                jamTotal = jamTotal + '' + i + '-' + (i+1) + ';';
                durasi+=1;
            }
        }
        $('#durasiJam').val(durasi);
        hitungDurasiJam();
        $('#jadwalJam').val(jamTotal);
        $('#modalJadwal').modal('hide');
    }

    $('#jadwalJam').on('click', function () {
        if($('#tanggalPinjamJam').val() == '')
            alert('isi tanggal terlebih dahulu');
        else
            $('#modalJadwal').modal('show');   
    });
 
    function cekJadwal() {
        $('#jadwalJam').val('');
        jamValue = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        for (var i = 0; i < jamValue.length; i++) {
            if($('#btnJadwal'+i).hasClass('btn-danger') == true){
                $('#btnJadwal'+i).removeClass("btn-danger");
                $('#btnJadwal'+i).addClass("btn-secondary");
                $('#btnJadwal'+i).attr("disabled", false);
            }
        }

        var linkGetJadwal = "{{ env('APP_API') }}/api/item/schedule/getJadwal.php";
        var tgl = $('#tanggalPinjamJam').val();
        $.post(linkGetJadwal, {id_item: myParam, date_transaction_start: tgl}, function(data) {
            for (var i = 0; i < data.length; i++) {
                var arrayJam = data[i].split(';');
                for (var j = 0; j < arrayJam.length; j++) {
                    var jamAwal = arrayJam[j].split('-');
                    $('#btnJadwal'+jamAwal[0]).removeClass("btn-secondary");
                    $('#btnJadwal'+jamAwal[0]).addClass("btn-danger");
                    $("#btnJadwal"+jamAwal[0]).attr("disabled", true);
                }
            }
        })
    }
</script>
@endsection