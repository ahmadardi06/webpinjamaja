@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/tracking-order.css') }}">
@endsection

@section('content')
    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'List')" id="defaultOpen">List Order</button>
        <button class="tablinks" onclick="openCity(event, 'Dikonfimasi')">Dikonfirmasi</button>
        <button class="tablinks" onclick="openCity(event, 'Dikirim')">Dikirim</button>
        <button class="tablinks" onclick="openCity(event, 'Dipinjam')">Dipinjam</button>
        <button class="tablinks" onclick="openCity(event, 'Selesai')">Selesai</button>
        <button class="tablinks" onclick="openCity(event, 'Batal')">Batal</button>
    </div>

    <div class="container">
        <div id="List" class="tabcontent">
            <span>loading...</span>
        </div>

        <div id="Dikonfimasi" class="tabcontent">
            <span>loading...</span>
        </div>

        <div id="Dikirim" class="tabcontent">
            <span>loading...</span>
        </div>

        <div id="Dipinjam" class="tabcontent">
            <span>loading...</span>
        </div>

        <div id="Selesai" class="tabcontent">
            <span>loading...</span>    
        </div>

        <div id="Batal" class="tabcontent">
            <span>loading...</span>
        </div>

    </div>

<div class="modal" id="myFirstModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Upload Bukti Pembayaran</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_transaction" id="id_transaction">
                <input type="hidden" name="id_user" id="id_user">
                <input type="hidden" name="img_bukti" id="img_bukti">
                <div class="form-group">
                    <label id="fileLabel">Upload Bukti</label>
                    <input type="hidden" id="fileHidden" name="fileHidden" value="">
                    <input type="file" accept="image/*" name="file" id="file" class="form-control" onchange="encodeImageFileAsURL(this)">
                </div>
                <div id="imgPreview"></div>
            </div>
            <div class="modal-footer">
                <button id="btnUploadSekarang" type="button" class="btn btn-danger">Upload</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        var userInfo = localStorage.getItem('user');
        var user = JSON.parse(userInfo);
        var randomString = '';

        function renderDOM(data) {
            var price = 'Rp'+parseInt(data.order_total).toLocaleString(); 
            if(data.status_order == 'pending') {
                var statusOrder = 'Menunggu Pembayaran';
            } else if(data.status_order == 'settlement') {
                var statusOrder = 'Sudah Dikonfirmasi';
            } else if(data.status_order == 'dikirim') {
                var statusOrder = 'Sedang Dikirim';
            } else if(data.status_order == 'dipinjam') {
                var statusOrder = 'Dipinjam';
            } else if(data.status_order == 'selesai') {
                var statusOrder = 'Selesai';
            } else if(data.status_order == 'expire') {
                var statusOrder = 'Batal';
            } else {
                var statusOrder = 'Status Tidak Tersedia';
            }

            var html = '';
            html += '<div class="item-category list-for-rent" style="border: 1px solid #e9e9e9; padding: 5px; margin: 3px; border-radius: 5px;">';
                html += '<div class="one-list-for-rent" style="margin: 2px 0px;">';
                    html += '<figure class="pic-for-rent">';
                        html += '<img src="'+data.items.img_item+'" class="">';
                    html += '</figure>';
                    html += '<div class="desc-for-rent">';
                        html += '<span class="desc" style="font-weight: bold;">'+data.store.store_name+'</span>';
                        html += '<span class="desc">'+data.items.item_name+'</span>';
                        html += '<span class="desc">'+price+'</span>';
                        html += '<span class="desc">'+data.date_transaction_start+' s/d '+data.date_transaction_end+'</span>';
                        html += '<span class="desc" style="color: red;">'+statusOrder+'</span>';
                    html += '</div>';
                html += '</div>';
                html += '<div class="row">';
                    html += '<div class="col col-sm-6" style="text-align: right;">';
                        if(data.status_order == 'pending') {
                            if(data.payment == 'LinkAja') {
                                html += '<button data-unique="'+data.unique_code+'" data-id="'+data.id_transaction+'" class="btn btn-sm btn-primary" onclick="uploadBukti(this)">Upload</button>';
                            } else {
                                html += '';
                            }
                        } else if(data.status_order == 'dikirim') {
                            html += '<button data-store="'+data.store.id_store+'" data-id="'+data.id_transaction+'" class="btn btn-sm btn-primary" onclick="terimaBarang(this)">Terima</button>';
                        }
                    html += '</div>';
                html += '</div>';
            html += '</div>';
            return html;
        }

        function terimaBarang(elem) {
            var transId = $(elem).attr('data-id');
            var userId = $(elem).attr('data-store');
            var statusOrder = 'dipinjam';
            var formData = { id_transaction: transId, id_store: userId, status_order: statusOrder };

            var linklihatPembayaran = "{{ env('APP_API') }}/api/transaction/store/statusOrder.php";
            $.post(linklihatPembayaran, formData, function(data){
                if(!data.error) {
                    window.location.href = "{{route('tracking-order')}}";
                }
            })
        }

        function encodeImageFileAsURL(element) {
            var file = element.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                $('#img_bukti').val(reader.result);
            }
        
            reader.readAsDataURL(file);
        }

        function uploadBukti(elem) {
            var transasctionId = $(elem).attr('data-id');
            $('#id_transaction').val(transasctionId);
            var linkUnique = "{{env('APP_API')}}/api/baskets/unique.php";
            $.post(linkUnique, {id_transaction: transasctionId}, function(data){
                if(!data.error){
                    randomString = data.data.unique_code;
                    $('#myFirstModal').modal('show');
                }
            })
        }

        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
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
        
        document.getElementById("defaultOpen").click();

        $(function(){
            if(userInfo == null) {
                window.location.href == "{{ route('login') }}";
            } else {
                var linkDiProses = "{{ env('APP_API') }}/api/transaction/user/orderTransaction.php";

                var formDataPending = {id_user: user.id_user, status_order: 'pending'};
                var formDataSettlement = {id_user: user.id_user, status_order: 'settlement'};
                var formDataDikirim = {id_user: user.id_user, status_order: 'dikirim'};
                var formDataDipinjam = {id_user: user.id_user, status_order: 'dipinjam'};
                var formDataSelesai = {id_user: user.id_user, status_order: 'selesai'};
                var formDataBatal = {id_user: user.id_user, status_order: 'expire'};

                $.post(linkDiProses, formDataPending, function(data){
                    console.log(data)
                    if(!data.error){
                        var html = '';
                        if(data.transactions.length != 0) {
                            for(var i=0; i<data.transactions.length; i++){
                                html += renderDOM(data.transactions[i]);
                            }
                        } else {
                            html += '<span>Tidak ada data</span>';
                        }
                        $('#List').html(html);
                    }
                })

                $.post(linkDiProses, formDataSettlement, function(data){
                    if(!data.error){
                        var html = '';
                        if(data.transactions.length != 0) {
                            for(var i=0; i<data.transactions.length; i++){
                                html += renderDOM(data.transactions[i]);
                            }
                        } else {
                            html += '<span>Tidak ada data</span>';
                        }
                        $('#Dikonfimasi').html(html);
                    }
                })

                $.post(linkDiProses, formDataDikirim, function(data){
                    if(!data.error){
                        var html = '';
                        if(data.transactions.length != 0) {
                            for(var i=0; i<data.transactions.length; i++){
                                html += renderDOM(data.transactions[i]);
                            }
                        } else {
                            html += '<span>Tidak ada data</span>';
                        }
                        $('#Dikirim').html(html);
                    }
                })

                $.post(linkDiProses, formDataDipinjam, function(data){
                    if(!data.error){
                        var html = '';
                        if(data.transactions.length != 0) {
                            for(var i=0; i<data.transactions.length; i++){
                                html += renderDOM(data.transactions[i]);
                            }
                        } else {
                            html += '<span>Tidak ada data</span>';
                        }
                        $('#Dipinjam').html(html);
                    }
                })

                $.post(linkDiProses, formDataSelesai, function(data){
                    if(!data.error){
                        var html = '';
                        if(data.transactions.length != 0) {
                            for(var i=0; i<data.transactions.length; i++){
                                html += renderDOM(data.transactions[i]);
                            }
                        } else {
                            html += '<span>Tidak ada data</span>';
                        }
                        $('#Selesai').html(html);
                    }
                })

                $.post(linkDiProses, formDataBatal, function(data){
                    if(!data.error){
                        var html = '';
                        if(data.transactions.length != 0) {
                            for(var i=0; i<data.transactions.length; i++){
                                html += renderDOM(data.transactions[i]);
                            }
                        } else {
                            html += '<span>Tidak ada data</span>';
                        }
                        $('#Batal').html(html);
                    }
                })

                $('#btnSubmitUpload').on('click', function(){
                    var transId = $('#id_transaction').val();
                    var userId = $('#id_user').val();
                    var imgBukti = $('#img_bukti').val();
                    var formData = { id_transaction: transId, id_user: userId, img_bukti: imgBukti };

                    var linkUploadBukti = "{{ env('APP_API') }}/api/transaction/user/uploadBukti.php";
                    $.post(linkUploadBukti, formData, function(data){
                        if(!data.error) {
                            window.location.href = "{{route('tracking-order')}}";
                        }
                    })
                })

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
            }
        })
    </script>
@endsection