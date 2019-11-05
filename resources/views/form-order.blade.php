@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/form-order.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
@endsection

@section('content')
<div class="product-pic">
    <img id="imgItem" src="{{ asset('tema/img/img1.jpg') }}">
</div>

<div class="container">
    <div class="product-name">
        <div class="name ">
            <span id="nameItem">loading...</span><br>
            <span id="priceItem" style="color: red;">loading...</span>
        </div>
        <a href="#">
            <div class="chat-button">
                <img src="{{ asset('tema/img/chat.png') }}" alt=""><br>
                <span>Tanya Penjual</span>
            </div>
        </a>
    </div>

    <div class="form item-margin">
        <form action="#" method="POST">
            <div class="align-left">
                <label>Tanggal Pinjam</label>
                <input type="text" name="tgl-pinjam" class="form-control tgl" id="tglPinjam"><br>

                <label>Tanggal Kembali</label>
                <input type="text" name="tgl-pinjam" class="form-control tgl" id="tglKembali"><br>

                <label>Jumlah</label><br>
                <a class="btn btn-default btn-min" id="min" onclick="kurangi()">-</a>
                <input type="number" id="jml" class="form-control jml" value="1">
                <a class="btn btn-default btn-plus" id="plus" onclick="tambahi()">+</a><br><br>

                <label>Opsi Pengiriman</label>
                <select name="cars" class="custom-select mb-3">
                    <option selected>Opsi Pengiriman</option>
                    <option value="Ambil Sendiri">Ambil Sendiri</option>
                    <option value="Diantar">Diantar</option>
                </select>
                <hr>
                <div class="total-price item-margin">
                    <div class="price-desc">
                        <span>Harga Sewa x 4 hari</span><br>
                        <span>Harga Sewa x 2 item</span>
                    </div>
                    <div class="price">
                        <span>Rp. 120.000</span><br>
                        <span>Rp. 60.000</span>
                    </div><hr>
                    <div class="price-desc">
                        <span>Total<br>
                    </div>
                    <div class="price">
                        <span style="color: red; font-weight: bold;">Rp. 180.000</span><br>
                    </div>
                </div>
            </div>
            
            <br>
            <a href="{{ route('payment') }}" class="btn btn-red btn-danger">Lanjut Pembayaran</a>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    var urlParams = new URLSearchParams(window.location.search);
    var myParam = urlParams.get('id');

    function formatRP(data) {
        return 'Rp'+parseInt(data).toLocaleString(); 
    }

    $(function(){
        $('#tglPinjam').datepicker();

        $('.tgl').datepicker({
            format: 'dd-mm-yyyy'
        }).on('hide', function(event) {
            event.preventDefault();
            event.stopPropagation();
        });
    })   

    var jml = document.getElementById('jml').value;
    jml = parseInt(jml);

    function tambahi(){
        jml++;
        document.getElementById('jml').value = jml;
    }
    function kurangi(){
        jml--;
        if(jml <= 0){
            document.getElementById('jml').value = 1;
        }
        else{
            document.getElementById('jml').value = jml;
        }
    }
</script>
@endsection