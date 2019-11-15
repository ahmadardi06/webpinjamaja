@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/list-item.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
@endsection

@section('content')
<div class="tab">
    <div class="title-page" >List Item</div>
    <!-- <a href="{{ route('list-item') }}?category=all" class="tablinks btn">All</a> -->
    <a href="javascript:;" id="btnFilterSearch" class="tablinks btn">Filter</a>
</div>

<div class="container" id="listItem">
    <div class="text-center">
        <span>loading...</span>
    </div>
</div>

<div class="modal" id="myModalFilterSearch">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titleModalFilter" class="modal-title">Filter</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            
            <div class="modal-body">
                <label class="control-label">Cari Barang</label>
                <input type="text" value="" name="filterNama" id="filterNama" placeholder="enter nama barang" class="form-control tgl"><br>

                <label>Lokasi Barang</label>
                <select class="form-control" name="filterLokasi" id="filterLokasi">
                    <option value="">== pilih kota ==</option>
                    <option value="Surabaya">Surabaya</option>
                    <option value="Sidoarjo">Sidoarjo</option>
                </select>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-success" id="btnTerapkan">Terapkan</button>
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    var urlOrigin = window.location.origin;
    var urlParams = new URLSearchParams(window.location.search);
    var myParam = urlParams.get('category');

    function renderDOM(data) {
        var price = 'Rp'+parseInt(data.price_day).toLocaleString(); 
        var html = '';
            html += '<div class="item-category list-for-rent">';
            html += '<a href="{{ route('detail-product') }}?id='+data.id_item+'" class="click-link">';
                html += '<div class="one-list-for-rent">';
                    html += '<figure class="pic-for-rent">';
                        html += '<img src="'+data.img_item+'" class="">';
                    html += '</figure>';
                    html += '<div class="desc-for-rent">';
                        html += '<span class="title-of-rent">'+data.item_name+'</span>';
                        html += '<span style="font-size: 12px;">Stok '+data.stock+'</span>';
                        html += '<span style="font-size: 18px; font-weight: bold">'+price+'</span>';
                        html += '<button class="btn btn-sm btn-primary">Pinjam Sekarang</button>';
                    html += '</div>';
                html += '</div>';
            html += '</a>';
        html += '</div>';
        return html;
    }

    $(function() {
        if(myParam != 'all') {
            var linkURL = "{{ env('APP_API') }}/api/item/itemCategory.php";
            var formData = {id_category: myParam};
        } else {
            var linkURL = "{{ env('APP_API') }}/api/item/readPaging.php?page=1";
            var formData = {};
        }

        console.log(linkURL)
        console.log(myParam)
        $.post(linkURL, formData, function(data) {
            if(!data.error){
                var html = '';
                for(var i=0; i<data.items.length; i++) {
                    html += renderDOM(data.items[i]);
                }
                $('#listItem').html(html);
            }
        })

        var linkAPICity = "{{ env('APP_API') }}/api/item/readCity.php";
        $.get(linkAPICity, function(data) {
            var html = '<option value="">== pilih kota ==</option>';
            if(!data.error) {
                for(var i=0; i<data.city.length; i++) {
                    if(data.city[i].city != null) {
                        html += '<option value="'+data.city[i].city+'">'+data.city[i].city+'</option>';
                    }
                }
            }
            $('#filterLokasi').html(html);
        })

        $('#btnFilterSearch').on('click', function(){
            $('#myModalFilterSearch').modal('show');
        })
        
        $('#btnTerapkan').on('click', function(){
            var namaFilter = $('#filterNama').val(), lokasiFilter = $('#filterLokasi').val();
            console.log({namaFilter, lokasiFilter})
            if(namaFilter == '' && lokasiFilter == '') {
                $('#titleModalFilter').html('Nama barang atau lokasi harus di isi.');
            } else {
                $('#myModalFilterSearch').modal('hide');

                var linkItemCategory = '{{env("APP_API")}}/api/item/itemCategory.php';
                $.post(linkItemCategory, {id_category: myParam == 'all' ? '8' : myParam, city: lokasiFilter}, function(data){
                    console.log(data);
                    var html = '';
                    if(!data.error){
                        if(data.items.length != 0) {
                            for(var i=0; i<data.items.length; i++){
                                html += renderDOM(data.items[i]);
                            }
                        } else {
                            html += '<span>Item tidak ditemukan.</span>';
                        }

                        $('#listItem').html(html);
                    }
                })
            }
        })
    })
</script>
@endsection