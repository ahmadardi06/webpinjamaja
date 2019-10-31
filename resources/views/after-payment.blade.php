@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form item-margin">
        <div class="align-left">
            <div>
                <span>Batas Waktu Pembayaran</span><br>
                <span style="font-weight: bold;">Jumat, 20 September 2019, 08.29</span>
            </div>
            <hr>
            <div class="total">
                <div class="total-desc">
                    <span>Jumlah Tagihan</span><br>
                    <span style="font-weight: bold;" id="total">Rp. 180.000</span>
                </div>
                <div class="copy">
                    <span style="color: red; cursor: pointer;" onclick="copyTotal()">Salin</span>
                </div>
            </div>
            <hr>
            <div class="payment-detail">
                <img src="{{ asset('tema/img/linkaja.jpg') }}" alt="LinkAja"><br>
                <span>Nomor LinkAja</span><br>
                <span style="font-weight: bold;">081234567876</span><br>
                <span style="color: red;">Salin Nomor</span>
            </div>
            <br>
            <p>Penyewaanmu dicatat dengan nomor taguhan pembayaran SW0014005001</p>
        </div>
        <br>
        <a href="{{ url('/') }}" class="btn btn-red btn-danger">Selesai</a>
    </div>
</div>
@endsection

@section('js')
<script>
    function copyTotal(){
        var copyText = document.getElementById("total").innerHTML;
        console.log(copyText);
        copyText[0].select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
    }
    
</script>
@endsection