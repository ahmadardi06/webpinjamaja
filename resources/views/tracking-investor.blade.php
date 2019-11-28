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
                <h5>Informasi Pembayaran</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_transaction" id="id_transaction">
                <input type="hidden" name="id_store" id="id_store">
                <div id="buktiPembayaran">                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btnKonfirmasi">Konfirmasi</button>
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
                        html += '<span class="desc" style="font-weight: bold;">'+data.user.full_name+'</span>';
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
                                html += '<button data-id="'+data.id_transaction+'" class="btn btn-sm btn-primary" onclick="lihatPembayaran(this)">Lihat Pembayaran</button>';
                            } else {
                                html += '<button data-id="'+data.id_transaction+'" class="btn btn-sm btn-primary" onclick="konfirmasiBarang(this)">Konfirmasi</button>&nbsp;<button data-id="'+data.id_transaction+'" class="btn btn-sm btn-primary" onclick="batalBarang(this)">Batal</button>';
                            }
                        } else if(data.status_order == 'settlement') {
                            if(data.delivery == 'diantar') {
                                html += '<button data-id="'+data.id_transaction+'" class="btn btn-sm btn-primary" onclick="kirimBarang(this)">Kirim</button>';
                            } else {
                                html += '<button data-id="'+data.id_transaction+'" class="btn btn-sm btn-primary" onclick="pinjamkanBarang(this)">Pinjamkan</button>';
                            }
                        } else if(data.status_order == 'dipinjam') {
                            html += '<button data-id="'+data.id_transaction+'" class="btn btn-sm btn-primary" onclick="selesaiBarang(this)">Selesai</button>';
                        }
                    html += '</div>';
                html += '</div>';
            html += '</div>';
            return html;
        }

        function lihatPembayaran(elem) {
            var transasctionId = $(elem).attr('data-id');
            var linkOrderDetail = "{{ env('APP_API') }}/api/transaction/store/orderDetail.php";
            $.post(linkOrderDetail, {id_transaction: transasctionId}, function(data){
                var splitImg = data.img_transaction.split('.');
                var formatImg = ['jpg','jpeg','png'];
                if(formatImg.includes(splitImg[splitImg.length-1])) {
                    $('#buktiPembayaran').html('<img src="'+data.img_transaction+'" class="img-responsive img-thumbnail">');
                    $('#id_transaction').val(transasctionId);
                    $('#id_store').val(user.id_store);
                    $('#btnKonfirmasi').show();
                } else {
                    $('#buktiPembayaran').html('<p>Bukti pembayaran belum diupload atau belum dibayar.</p>');
                    $('#btnKonfirmasi').hide();
                }
                $('#myFirstModal').modal('show');
            })
        }

        function kirimBarang(elem) {
            var transId = $(elem).attr('data-id');
            var userId = user.id_store;
            var statusOrder = 'dikirim';
            var formData = { id_transaction: transId, id_store: userId, status_order: statusOrder };

            var linklihatPembayaran = "{{ env('APP_API') }}/api/transaction/store/statusOrder.php";
            $.post(linklihatPembayaran, formData, function(data){
                if(!data.error) {
                    window.location.href = "{{route('tracking-order-investor')}}";
                }
            })
        }

        function pinjamkanBarang(elem) {
            var transId = $(elem).attr('data-id');
            var userId = user.id_store;
            var statusOrder = 'dipinjam';
            var formData = { id_transaction: transId, id_store: userId, status_order: statusOrder };

            var linklihatPembayaran = "{{ env('APP_API') }}/api/transaction/store/statusOrder.php";
            $.post(linklihatPembayaran, formData, function(data){
                if(!data.error) {
                    window.location.href = "{{route('tracking-order-investor')}}";
                }
            })
        }

        function konfirmasiBarang(elem) {
            var transId = $(elem).attr('data-id');
            var userId = user.id_store;
            var statusOrder = 'settlement';
            var formData = { id_transaction: transId, id_store: userId, status_order: statusOrder };

            var linklihatPembayaran = "{{ env('APP_API') }}/api/transaction/store/statusOrder.php";
            $.post(linklihatPembayaran, formData, function(data){
                if(!data.error) {
                    window.location.href = "{{route('tracking-order-investor')}}";
                }
            })
        }

        function selesaiBarang(elem) {
            var transId = $(elem).attr('data-id');
            var userId = user.id_store;
            var statusOrder = 'selesai';
            var formData = { id_transaction: transId, id_store: userId, status_order: statusOrder };

            var linklihatPembayaran = "{{ env('APP_API') }}/api/transaction/store/statusOrder.php";
            $.post(linklihatPembayaran, formData, function(data){
                if(!data.error) {
                    window.location.href = "{{route('tracking-order-investor')}}";
                }
            })
        }

        function batalBarang(elem) {
            var transId = $(elem).attr('data-id');
            var userId = user.id_store;
            var statusOrder = 'expire';
            var formData = { id_transaction: transId, id_store: userId, status_order: statusOrder };

            var linklihatPembayaran = "{{ env('APP_API') }}/api/transaction/store/statusOrder.php";
            $.post(linklihatPembayaran, formData, function(data){
                if(!data.error) {
                    window.location.href = "{{route('tracking-order-investor')}}";
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
        
        document.getElementById("defaultOpen").click();

        $(function(){
            $('#btnKonfirmasi').hide();

            if(userInfo == null) {
                window.location.href == "{{ route('login') }}";
            } else {
                var linkURLRedirect = "{{ env('APP_API') }}/api/store/userStore.php";
                $.post(linkURLRedirect, {id_user: user.id_user}, function(data) {
                    user.id_store = data.id_store;
                });

                var linkDiProses = "{{ env('APP_API') }}/api/transaction/store/orderTransaction.php";

                var formDataPending = {id_store: user.id_store, status_order: 'pending'};
                var formDataSettlement = {id_store: user.id_store, status_order: 'settlement'};
                var formDataDikirim = {id_store: user.id_store, status_order: 'dikirim'};
                var formDataDipinjam = {id_store: user.id_store, status_order: 'dipinjam'};
                var formDataSelesai = {id_store: user.id_store, status_order: 'selesai'};
                var formDataBatal = {id_store: user.id_store, status_order: 'expire'};

                $.post(linkDiProses, formDataPending, function(data){
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

                $('#btnKonfirmasi').on('click', function(){
                    var transId = $('#id_transaction').val();
                    var userId = $('#id_store').val();
                    var statusOrder = 'settlement';
                    var formData = { id_transaction: transId, id_store: userId, status_order: statusOrder };

                    var linklihatPembayaran = "{{ env('APP_API') }}/api/transaction/store/statusOrder.php";
                    $.post(linklihatPembayaran, formData, function(data){
                        if(!data.error) {
                            window.location.href = "{{route('tracking-order-investor')}}";
                        }
                    })
                })
            }
        })
    </script>
@endsection