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
                    <option value="LinkAja">Link Aja</option>
                    <option value="midtrans">Transfer Bank</option>
                    <option value="bayar ditempat">Bayar Ditempat</option>
                </select>

                <label>Metode Pengiriman</label>
                <select id="pengiriman" name="pengiriman" class="custom-select mb-3">
                    <option selected disabled>Metode Pengiriman</option>
                    <option value="diantar">Diantar / Dikirim</option>
                    <option value="ambil sendiri">Ambil Sendiri</option>
                </select>

                <hr>
                <h5>Daftar Belanja</h5>

                <div class="list-product" id="myBasket">
                    <span>loading...</span>
                </div>
                
                <hr>
                <label>Catatan Tambahan</label>
                <input type="text" name="note" id="note" class="form-control">
                <br>

                <label>Alamat Pengiriman</label>
                <textarea class="form-control" placeholder="alamat tujuan..." id="alamat" name="alamat"></textarea>

                <hr>
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
            <a style="margin-top: 10px;" href="javascript:;" class="btn btn-red btn-danger" id="checkFormData">Check Form Data</a>

        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-UAsmCx6rgN2JFl33"></script>
<script>
    var userInfo = localStorage.getItem('user');
    var user = JSON.parse(userInfo);
    var grandTotal = 0;
    var randomDigit = randomRange(300, 501);
    var randomString = makeRandomString(11);
    var tokenMidtrans = '';
    var myBaskets = [];
    var formBaskets = {};

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
                html += '<a data-id="'+data.id+'" data-harga="'+data.total+'" onclick="deleteItem(this)" style="float: right; text-decoration: none;" href="javascript:;">hapus</a>';
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
                var html = '';
                if(data.data.length == 0) {
                    window.location.href = "{{ route('app') }}";
                } else {
                    for(var i=0; i<data.data.length; i++){
                        html += renderDOM(data.data[i]);    
                        grandTotal += Number(data.data[i].total);
                        myBaskets.push(data.data[i]);
                    }
                }
                formBaskets.items =myBaskets;
                $('#myBasket').html(html);
                $('#totalPrice').html(formatRP(grandTotal));
            });

            var linkGetAddress = "{{ env('APP_API') }}/api/user/userDetail.php";
            $.post(linkGetAddress, {id_user: user.id_user}, function(data) {
                if(!data.error) {
                    $('#alamat').val(data.address);
                }
            })

            $('#pengiriman').on('change', function() {
                var thisValue = $(this).val();
                console.log(thisValue)
            })

        }

        $('#checkFormData').on('click', function() {
            formBaskets.note = $('#note').val();
            formBaskets.address = $('#alamat').val();
            formBaskets.payment = $('#payment').val();
            formBaskets.delivery = $('#pengiriman').val();
            formBaskets.unique = makeRandomString(11);

            if(formBaskets.payment == null) {
                $('#payment').focus();
            }

            if(formBaskets.delivery == null) {
                $('#pengiriman').focus();
            }

            console.log(formBaskets);
        })
    })

    function randomRange(min, max) {
      return ~~(Math.random() * (max - min + 1)) + min
    }

    function makeRandomString(length) {
       var result           = '';
       var characters       = 'abcdefghijklmnopqrstuvwxyz0123456789';
       var charactersLength = characters.length;
       for ( var i = 0; i < length; i++ ) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
       }
       return result;
    }

    document.getElementById('buttonBayarMidtrans').onclick = function(){
      var requestBody = 
      {
        transaction_details: {
          gross_amount: Number(grandTotal) + randomDigit,
          order_id: 'INV-'+Math.round((new Date()).getTime() / 1000) + '-' + randomDigit
        },
        callbacks: {
            finish: "{{ route('activity') }}"
        }
      }
      
      getSnapToken(requestBody, function(response){
        var response = JSON.parse(response);
        console.log("new token response", response);
        tokenMidtrans = response.token;
        formBaskets.token = response.token;
        snap.pay(response.token, {
            onSuccess: function(result) {
                console.log('Success: ', result);
            },
            onPending: function(result) {
                console.log('Pending: ', result);
            },
            onError: function(result) {
                console.log('Error: ', result);
            }
        });
      })
    };

    function getSnapToken(requestBody, callback) {
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.onreadystatechange = function() {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
          callback(xmlHttp.responseText);
        }
      }
      xmlHttp.open("post", "http://pinjemaja.store/webpayment/checkout.php");
      // xmlHttp.open("post", "http://localhost/midtrans/checkout.php");
      xmlHttp.send(JSON.stringify(requestBody));
    }

    function convertTglIndo(data) {
        var split = data.split('-');
        return split[2]+'-'+split[1]+'-'+split[0];
    }

    function deleteItem(ele) {
        var id = $(ele).attr('data-id');
        var harga = $(ele).attr('data-harga');
        var linkDelete = "{{ env('APP_API') }}/api/baskets/delete.php";
        $.post(linkDelete, {id: id}, function(data) {
            if(!data.error){
                var hitung = grandTotal - Number(harga);
                grandTotal = grandTotal - Number(harga);
                $('#totalPrice').html(formatRP(hitung));
                $(ele).parent().parent().remove();
            }
        })
    }
</script>
@endsection