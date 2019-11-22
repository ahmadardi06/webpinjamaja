@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('tema/css/rent-product.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="product-store">
        <div class="store-pic">
            <img id="imgStore" src="{{ asset('tema/img/img1.jpg') }}" alt="Store">
        </div>
        <div class="store-name">
            <span id="nameStore" style="font-weight: bold; font-size: 16px;">loading...</span><br>
            <span id="emailStore">loading...</span><br>
            <span id="phoneStore">loading...</span>
        </div>
    </div>

    <div class="ready-item item-margin">
        <h6>
            Ready Items
            <a id="btnKembali" style="float: right; text-decoration: none;" href="{{ route('rent-product') }}">Kembali</a>
        </h6>
        <div class="row text-left" id="listItems" style="margin: 5px;">
            <p class="text-center">loading...</p>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        var urlParams = new URLSearchParams(window.location.search);
        var myParam = urlParams.get('id');
        var urlOrigin = window.location.origin;
        var userInfo = localStorage.getItem('user');
        var user = JSON.parse(userInfo);

        function renderDOM(data) {
            var htmlPrice = '';
            if(data.price_hour != 0) { htmlPrice = 'Rp'+parseInt(data.price_hour).toLocaleString()+'/jam'; }
            if(data.price_day != 0) { htmlPrice = 'Rp'+parseInt(data.price_day).toLocaleString()+'/hari'; }
            if(data.price_week != 0) { htmlPrice = 'Rp'+parseInt(data.price_week).toLocaleString()+'/minggu'; }
            if(data.price_month != 0) { htmlPrice = 'Rp'+parseInt(data.price_month).toLocaleString()+'/bulan'; }
            var price = htmlPrice; 
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

        function formatRP(data) {
            return 'Rp'+parseInt(data).toLocaleString(); 
        }

        $(function(){
            $('#userLogin').hide();
            $('#btnEditStore').hide();

            $('#detailInvestor').attr('href', $('#detailInvestor').attr('href')+'?id='+myParam);
            $('#btnKembali').attr('href', $('#btnKembali').attr('href')+'?id='+myParam);

            var linkURL = "{{ env('APP_API') }}/api/store/storeDetail.php";
            $.post(linkURL, {id_store: myParam}, function(data){
                if(data.fk_user == user.id_user) {
                    $('#userLogin').show();
                    $('#btnEditStore').show();
                } else {
                    $('#btnEditStore').hide();
                    $('#userLogin').hide();
                }
            })

            $.post(linkURL, {id_store: myParam}, function(data){
                $('#imgStore').attr('src', data.img_store);
                $('#nameStore').html(data.store_name);
                $('#phoneStore').html(data.city);
                $('#emailStore').html(data.address);
            })

            var linkURLItems = "{{ env('APP_API') }}/api/store/readItemStore.php?page=2";
            $.post(linkURLItems, {id_store: myParam}, function(data) {
                if(!data.error) {
                    var html = '';
                    for(var i=0; i<data.items.length; i++) {
                        html += renderDOM(data.items[i]);
                    }
                    $('#listItems').html(html);
                }
            })
        })
    </script>
@endsection