@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/payment.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="form">
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

                <div class="list-product" id="myBasket">
                    <span>loading...</span>
                </div>
                
                <hr>
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
            <a style="margin-top: 10px;" href="{{ route('list-item') }}?category=all" class="btn btn-red btn-danger">Tambah Item Lain</a>

        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="Mid-client-UAsmCx6rgN2JFl33"></script>
<script>
    var userInfo = localStorage.getItem('user');
    var user = JSON.parse(userInfo);
    var grandTotal = 0;

    function formatRP(data) {
        return 'Rp'+parseInt(data).toLocaleString(); 
    }

    function renderDOM(data) {
        var html = '';
        html += '<div style="border: 1px solid #e9e9e9; margin: 5px; padding: 5px;">';
            html += '<div class="store-icon">';
                html += '<img id="imgStore" src="{{ env('APP_API') }}/asset/store/'+data.item.id_store+'/profile/'+data.item.img_store+'">';
            html += '</div>';
            html += '<div class="store-name">';
                html += '<span id="nameStore"><a href="{{ route('rent-product') }}?id='+data.item.id_store+'">'+data.item.store_name+'</a></span>';
            html += '</div><hr>';
            html += '<div class="product-pic">';
                html += '<img id="imgItem" src="{{ env('APP_API') }}/asset/store/'+data.item.id_store+'/items/'+data.item_id+'/'+data.item.img_item+'" class="">';
            html += '</div>';
            html += '<div class="product-desc">';
                html += '<a data-id="'+data.id+'" onclick="deleteItem(this)" style="float: right; text-decoration: none;" href="javascript:;">hapus</a>';
                html += '<span id="nameItem" style="font-weight: bold;">'+data.item.item_name+'</span><br>';
                html += '<span id="amountItem">Amount '+data.amount+'</span><br>';
                html += '<span id="dateItem">'+convertTglIndo(data.date_start)+' s/d '+convertTglIndo(data.date_end)+'</span><br>';
                html += '<span>'+formatRP(data.total)+'</span>';
            html += '</div>';
        html += '</div>';
        return html;
    }

    $(function(){
        if(userInfo == null) {
            window.location.href = "{{ route('login') }}";
        } else {
            var linkDetail = "{{ env('APP_API') }}/api/baskets/mybasket.php";
            $.post(linkDetail, {user_id: user.id_user}, function(data){
                console.log(data);
                var html = '';
                if(data.data.length == 0) {
                    window.location.href = "{{ route('app') }}";
                } else {
                    for(var i=0; i<data.data.length; i++){
                        html += renderDOM(data.data[i]);    
                        grandTotal += Number(data.data[i].total);
                    }
                }
                $('#myBasket').html(html);
                $('#totalPrice').html(formatRP(grandTotal));
            });

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
        }
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
          gross_amount: Number(grandTotal) + randomRange(300, 501),
          // as example we use timestamp as order ID
          order_id: 'INV-'+Math.round((new Date()).getTime() / 1000) 
        },
        callbacks: {
            finish: "{{ route('activity') }}"
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

    function convertTglIndo(data) {
        var split = data.split('-');
        return split[2]+'-'+split[1]+'-'+split[0];
    }

    function deleteItem(ele) {
        var id = $(ele).attr('data-id');
        var linkDelete = "{{ env('APP_API') }}/api/baskets/delete.php";
        $.post(linkDelete, {id: id}, function(data) {
            if(!data.error){
                $(ele).parent().parent().remove();
            }
        })
    }
</script>
@endsection