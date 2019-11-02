@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/app.css') }}">
@endsection

@section('content')
<div class="container">
        <div class="item-category" id="menuItem">
            <span>loading...</span>
        </div>
                
        <div class="item-category for-carousel">
            <div id="demo" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                </ul>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('tema/img/img3.jpg') }}" alt="img1">  
                        <div class="carousel-caption">
                            <h3>Stik Golf</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('tema/img/img3.jpg') }}" alt="img2">  
                        <div class="carousel-caption">
                            <h3>Barang Kedua</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('tema/img/img3.jpg') }}" alt="img2">  
                        <div class="carousel-caption">
                            <h3>Barang Ketiga</h3>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>  


        <div id="listItem">
            <div class="text-center">
                <span>loading...</span>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var urlOrigin = window.location.origin;

        function renderMenuDOM(data) {
            var html = '';
            html += '<a href="{{ route('list-item') }}?category='+data.category+'" class="per-category">';
                html += '<div class="menu category-menu" style="width: 100%;">';
                    html += '<div class="menu-icon">';
                        html += '<img src="'+data.icon+'">';
                    html += '</div>';
                    html += '<div class="menu-text">';
                        html += '<span>'+data.category+'</span>';
                    html += '</div>';
                html += '</div>';
            html += '</a>';
            return html;
        }

        function renderListDOM(data) {
            var price = 'Rp'+parseInt(data.price).toLocaleString(); 
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
            // var linkURL = urlOrigin+"/database/category.json";
            var linkURL = "http://194.31.53.14/pinjem/api/item/category.php";
            $.get(linkURL, function(data) {
                if(!data.error){
                    var html = '';
                    for(var i=0; i<data.items.length; i++) {
                        html += renderMenuDOM(data.items[i]);
                    }
                    $('#menuItem').html(html);
                }
            })

            // var linkURL = urlOrigin+"/database/listitem.json";
            var linkURL = "http://194.31.53.14/pinjem/api/item/readItems.php";
            $.get(linkURL, function(data) {
                if(!data.error){
                    var html = '';
                    for(var i=0; i<5; i++) {
                        html += renderListDOM(data.items[i]);
                    }
                    $('#listItem').html(html);
                }
            })

            $('#btnLogin').on('click', function(){
                var formData = { user: 'ahmad', pass: 'ardiansyah' };
                localStorage.setItem('user', JSON.stringify(formData));
            })

            $('#btnCheck').on('click', function(){
                console.log(localStorage.getItem('user'));
            })

            $('#btnLogout').on('click', function(){
                console.log(localStorage.clear());
            })
        })
    </script>
@endsection
