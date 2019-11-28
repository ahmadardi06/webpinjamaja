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

                <label id="alamatPengiriman">Alamat Pengiriman</label>
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
            <button id="buttonBayarLinkAja" type="submit" class="btn btn-red btn-danger">Bayar Sekarang</button>
            <button id="buttonBayarMidtrans" type="submit" class="btn btn-red btn-danger">Bayar Sekarang</button>
            <button id="buttonBayarDiTempat" type="submit" class="btn btn-red btn-danger">Bayar Sekarang</button>
            <a style="margin-top: 10px;" href="{{ route('list-item') }}?category=all" class="btn btn-red btn-danger">Tambah Item Lain</a>

        </div>
    </div>
</div>

<div class="modal" id="modalLinkAja">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5>Pembayaran via LinkAja</h5>
                <ul>
                    <li>Buka aplikasi LinkAja</li>
                    <li>Pilih emnu Bayar</li>
                    <li>Scan QR Code</li>
                    <li>Pilih kirim uang</li>
                    <li>Masukan nominal bayar</li>
                    <li>Screenshot pembayaran</li>
                    <li>Selesai</li>
                </ul>
                <div class="form-group">
                    <label id="fileLabel">Upload Bukti</label>
                    <input type="hidden" id="fileHidden" name="fileHidden" value="">
                    <input type="file" accept="image/*" name="file" id="file" class="form-control" onchange="encodeImageFileAsURL(this)">
                </div>
                <div id="imgPreview"></div>
            </div>
            <div class="modal-footer">
                <button id="btnUploadSekarang" type="button" class="btn btn-danger">Upload Sekarang</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Nanti Saja</button>
            </div>
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
    var randomString = '';
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
        $('#buttonBayarLinkAja').show();
        $('#buttonBayarMidtrans').hide();
        $('#buttonBayarDiTempat').hide();

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
                user.alamat = data.address;
                if(!data.error) {
                    $('#alamat').val(data.address);
                }
            })

            $('#pengiriman').on('change', function() {
                var thisValue = $(this).val();
                if(thisValue == 'diantar') {
                    $('#alamatPengiriman').html('Alamat Pengiriman');
                    $('#alamat').val(user.alamat);
                } else {
                    $('#alamatPengiriman').html('Bayar Dialamat');
                    $('#alamat').val(myBaskets[0].item.store_address);
                }
            });

            $('#payment').on('change', function(){
                var thisValue = $(this).val();
                if(thisValue == 'LinkAja') {
                    $('#buttonBayarLinkAja').show();
                    $('#buttonBayarMidtrans').hide();
                    $('#buttonBayarDiTempat').hide();
                } else if(thisValue == 'midtrans') {
                    $('#buttonBayarLinkAja').hide();
                    $('#buttonBayarMidtrans').show();
                    $('#buttonBayarDiTempat').hide();
                } else {
                    $('#buttonBayarLinkAja').hide();
                    $('#buttonBayarMidtrans').hide();
                    $('#buttonBayarDiTempat').show();
                }
            })

        }

        $('#buttonBayarLinkAja').on('click', function(){
            formBaskets.note = $('#note').val();
            formBaskets.address = $('#alamat').val();
            formBaskets.payment = $('#payment').val();
            formBaskets.delivery = $('#pengiriman').val();
            formBaskets.unique = makeRandomString(11);

            if($('#payment').val() == null) {
                $('#payment').focus();
            } else if($('#pengiriman').val() == null) {
                $('#pengiriman').focus();
            } else {
                randomString = formBaskets.unique;
                saveTransaction(formBaskets, 'pending');
                $('#modalLinkAja').modal('show');
            }
        });

        $('#btnUploadSekarang').on('click', function(){
            var fileHidden = $('#fileHidden').val();
            var linkURLTransaction = "{{ env('APP_API') }}/api/baskets/transaction.php";
            if(fileHidden == ""){
                $('#fileLabel').html('Upload Bukti Harus Terisi').css('color', 'red');
                $('#file').focus();
            } else {
                $.post(linkURLTransaction, {unique_code: randomString}, function(data){
                    var linkUploadBukti = "{{ env('APP_API') }}/api/transaction/user/uploadBukti.php";
                    $.post(linkUploadBukti, {id_user: user.id_user, id_transaction: data.data.id_transaction, img_bukti: $('#fileHidden').val()}, function(result){
                        if(!result.error){
                            window.location.href = "{{ route('activity') }}";
                        }
                    })
                })
            }
        })

        $('#buttonBayarMidtrans').on('click', function(){
            var requestBody = {
                transaction_details: {
                  gross_amount: Number(grandTotal) + randomDigit,
                  order_id: 'INV-'+Math.round((new Date()).getTime() / 1000) + '-' + randomDigit
                },
                callbacks: {
                    finish: "{{ route('activity') }}"
                }
            };

            formBaskets.note = $('#note').val();
            formBaskets.address = $('#alamat').val();
            formBaskets.payment = $('#payment').val();
            formBaskets.delivery = $('#pengiriman').val();
            formBaskets.unique = makeRandomString(11);

            if($('#payment').val() == null) {
                $('#payment').focus();
            } else if($('#pengiriman').val() == null) {
                $('#pengiriman').focus();
            } else {
                getSnapToken(requestBody, function(response){
                    var response = JSON.parse(response);
                    // console.log("new token response", response);
                    tokenMidtrans = response.token;
                    formBaskets.token = response.token;

                    snap.pay(response.token, {
                        onSuccess: function(result) {
                            console.log('Success: ', result);
                            saveTransaction(formBaskets, 'settlement');
                            window.location.href = "{{ route('activity') }}";
                        },
                        onPending: function(result) {
                            console.log('Pending: ', result);
                            saveTransaction(formBaskets, 'pending');
                            window.location.href = "{{ route('activity') }}";
                        },
                        onError: function(result) {
                            console.log('Error: ', result);
                        }
                    });
                })
            }
        });

        $('#buttonBayarDiTempat').on('click', function(){
            formBaskets.note = $('#note').val();
            formBaskets.address = $('#alamat').val();
            formBaskets.payment = $('#payment').val();
            formBaskets.delivery = $('#pengiriman').val();
            formBaskets.unique = makeRandomString(11);

            if($('#payment').val() == null) {
                $('#payment').focus();
            } else if($('#pengiriman').val() == null) {
                $('#pengiriman').focus();
            } else {
                randomString = formBaskets.unique;
                saveTransaction(formBaskets, 'pending');
                window.location.href = "{{route('activity')}}";
            }
        });

    });

    function saveTransaction(data, status) {
        var formData = { 
            id_user: user.id_user, order_note: data.note, status_order: status,
            unique_code: data.unique, payment: data.payment, delivery: data.delivery,
            address_delivery: data.address, metode_pembayaran: data.payment, id_midtrans: data.token
        };
        for(let i=0; i<data.items.length; i++) {
            formData.id_item = data.items[i].item_id;
            formData.date_transaction_start = data.items[i].date_start;
            formData.date_transaction_end = data.items[i].date_end;
            formData.order_amount = data.items[i].amount;
            formData.order_total = data.items[i].total;
            formData.duration_rent = null;
            formData.time_rent = null;

            var linkSaveTransaction = "{{ env('APP_API') }}/api/transaction/simpanTransaksi.php";
            $.post(linkSaveTransaction, formData, function(data) {
                console.log(data);
            })
            
            var linkRemoveBasets = "{{ env('APP_API') }}/api/baskets/delete.php";
            $.post(linkRemoveBasets, {id: data.items[i].id}, function(data){ 
                console.log(data);
            });
        }
    }

    function randomRange(min, max) {
      return ~~(Math.random() * (max - min + 1)) + min
    }

    function makeRandomString(length) {
       var result           = '';
       var characters       = 'abcdefghijklmnopqrstuvwxyz0123456789';
       var charactersLength = characters.length;
       var date = new Date();
       var formatDate = date.getFullYear() + ("0" + (date.getMonth() + 1)).slice(-2) + ("0" + date.getDate()).slice(-2) + ("0" + date.getHours() + 1 ).slice(-2) + ("0" + date.getMinutes()).slice(-2) + ("0" + date.getSeconds()).slice(-2);
       for ( var i = 0; i < length; i++ ) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
       }
       return user.id_user + '' + formatDate + '' + result;
    }

    function getSnapToken(requestBody, callback) {
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.onreadystatechange = function() {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
          callback(xmlHttp.responseText);
        }
      }
      // xmlHttp.open("post", "http://pinjemaja.store/webpayment/checkout.php");
      xmlHttp.open("post", "http://localhost/midtrans/checkout.php");
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
                window.location.reload();
            }
        })
    }

    function encodeImageFileAsURL(element) {
        var file = element.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
            $('#imgPreview').html('<img src="'+reader.result+'" class="img-thumbnail" width="200px"/>');
        }
        reader.readAsDataURL(file);
        handleFileSelect(element);
    }

    function handleFileSelect(evt) {
      var f = evt.files[0];
      var reader = new FileReader();
      reader.onload = (function(theFile) {
        return function(e) {
          var binaryData = e.target.result;
          var base64String = window.btoa(binaryData);
          $('#fileHidden').val(base64String);
        };
      })(f);
      reader.readAsBinaryString(f);
    }
</script>
@endsection