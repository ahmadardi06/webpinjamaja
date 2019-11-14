@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/list-item.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
@endsection

@section('content')
    <div class="tab">
        <div class="title-page" >List Item</div>
        <a href="{{ route('list-item') }}?category=all" class="tablinks btn">All</a>
        <!-- <button class="tablinks" data-toggle="modal" data-target="#myModal"> -->
            <!-- All -->
        <!-- </button> -->
    </div>

    <div class="container" id="listItem">

        <div class="text-center">
            <span>loading...</span>
        </div>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Filter</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="#">
                            <label>Tanggal Pinjam</label>
                            <input type="text" name="tgl-pinjam" class="form-control tgl"><br>
    
                            <label>Tanggal Kembali</label>
                            <input type="text" name="tgl-kembali" class="form-control tgl"><br>

                            <label>Lokasi</label>
                            <input type="text" name="lokasi" class="form-control"><br>

                            <label>Merek</label>
                            <input type="text" name="Merek" class="form-control">                            
                        </form>
                        
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Terapkan</button>
                    </div>
                    
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
        // $('.tgl').datepicker({ format: 'dd-mm-yyyy' }).on('hide', function(event) {
            // event.preventDefault();
            // event.stopPropagation();
        // });

        if(myParam != 'all') {
            var linkURL = "{{ env('APP_API') }}/api/item/itemCategory.php";
            var formData = {id_category: myParam};
        } else {
            var linkURL = "{{ env('APP_API') }}/api/item/readPaging.php?page=1";
            var formData = {};
        }
        $.post(linkURL, {id_category: myParam}, function(data) {
            if(!data.error){
                var html = '';
                for(var i=0; i<data.items.length; i++) {
                    html += renderDOM(data.items[i]);
                }
                $('#listItem').html(html);
            }
        })
    })
</script>
@endsection