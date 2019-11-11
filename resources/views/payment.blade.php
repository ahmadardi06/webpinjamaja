@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/payment.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="form item-margin">
        <div class="form">
            <div class="align-left">
                <label>Metode Pembayaran</label>
                <select id="payment" name="payment" class="custom-select mb-3">
                    <option selected disabled>Metode Pembayaran</option>
                    <option value="linkaja">Link Aja</option>
                    <option value="bayarditempat">Bayar Di Tempat</option>
                    <option value="transfer">Transfer Bank</option>
                </select>
                <hr>
                <h5>Daftar Belanja</h5>

                <div class="product-store item-margin">
                    <div class="store-icon">
                        <img id="imgStore" src="{{ asset('tema/img/store.png') }}">
                    </div>
                    <div class="store-name">
                        <span id="nameStore">loading...</span>
                    </div>
                </div>

                <div class="list-product">
                    <figure class="product-pic">
                        <img id="imgItem" src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="product-desc">
                        <span id="nameItem" style="font-weight: bold;">loading...</span><br>
                        <span id="amountItem">loading...</span><br>
                        <span id="dateItem">loading... s/d loading...</span>
                    </div>
                </div>
                
                <label>Catatan Tambahan</label>
                <input type="text" name="note" id="note" class="form-control">

                <div class="total-price item-margin">
                    <div class="price-desc">
                        <span>Total yang harus dibayar<br>
                    </div>
                    <div class="price">
                        <span id="totalPrice" style="color: red; font-weight: bold;">loading...</span><br>
                    </div>
                </div>
            </div>
            
            <!-- <button id="buttonBayar" type="submit" class="btn btn-red btn-danger">Bayar Sekarang</button> -->
            <button id="buttonBayarMidtrans" type="submit" class="btn btn-red btn-danger">Bayar Sekarang</button>

        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-lOOPKaHMI2vqnvNJ"></script>
<script>
    var urlParams = new URLSearchParams(window.location.search);
    var search = location.search.substring(1);
    var decodeQueryString = JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}')

    function formatRP(data) {
        return 'Rp'+parseInt(data).toLocaleString(); 
    }

    $(function(){
        var linkDetail = "{{ env('APP_API') }}/api/item/itemDetail.php";
        $.post(linkDetail, {id_item: urlParams.get('id_item')}, function(data){
            $('#imgStore').attr('src', data.store.img_store);
            $('#nameStore').html(data.store.store_name);

            $('#imgItem').attr('src', data.img_item);
            $('#nameItem').html(data.item_name);
            $('#amountItem').html('Quantity '+urlParams.get('amount'));

            $('#totalPrice').html(formatRP(urlParams.get('total')));
            $('#dateItem').html(urlParams.get('date_start')+' s/d '+urlParams.get('date_end'));
        })

        $('#buttonBayar').on('click', function(data){
            if($('#payment').val() == '') {
                $('#payment').focus();
            } else {
                var formData = decodeQueryString;
                formData.note = $('#note').val();
                formData.payment = $('#payment').val();

                var linkOrder = "{{ env('APP_API') }}/api/transaction/user/order.php";
                $.post(linkOrder, formData, function(data){
                    console.log(data);
                    if(!data.error) {
                        window.location.href = "{{ route('activity') }}"
                    }
                })
            }
        })
    })

    function randomRange(min, max) {
      return ~~(Math.random() * (max - min + 1)) + min
    }

    document.getElementById('buttonBayarMidtrans').onclick = function(){
      // This is minimal request body as example.
      // Please refer to docs for all available options: https://snap-docs.midtrans.com/#json-parameter-request-body
      // TODO: you should change this gross_amount and order_id to your desire. 
      var requestBody = 
      {
        transaction_details: {
          gross_amount: Number(urlParams.get('total')) + randomRange(300, 501),
          // as example we use timestamp as order ID
          order_id: 'INV-'+Math.round((new Date()).getTime() / 1000) 
        }
      }
      
      getSnapToken(requestBody, function(response){
        var response = JSON.parse(response);
        console.log("new token response", response);
        // Open SNAP payment popup, please refer to docs for all available options: https://snap-docs.midtrans.com/#snap-js
        snap.pay(response.token);
      })
    };
    /**
    * Send AJAX POST request to checkout.php, then call callback with the API response
    * @param {object} requestBody: request body to be sent to SNAP API
    * @param {function} callback: callback function to pass the response
    */
    function getSnapToken(requestBody, callback) {
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.onreadystatechange = function() {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
          callback(xmlHttp.responseText);
        }
      }
      xmlHttp.open("post", "http://pinjemaja.store/webpayment/checkout.php");
      xmlHttp.send(JSON.stringify(requestBody));
    }
</script>
@endsection