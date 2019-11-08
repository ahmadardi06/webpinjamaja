@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/app.css') }}">
@endsection

@section('content')
<div class="container">
        <div class="item-category" id="menuItem">
            <span>loading...</span>
        </div>

        <br>
                
        <div class="item-category for-carousel">
            <div id="demo" class="carousel slide" data-ride="carousel">
                <span>loading...</span>
            </div>
        </div>

        <br>

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
            html += '<a href="{{ route('list-item') }}?category='+data.id_category+'" class="per-category">';
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

        function renderSliderDOM(data) {
            var indicator = ''; var slider = '';
            for(var i=0; i<data.length; i++) {
                if(i == 0){
                    indicator += '<li data-target="#demo" data-slide-to="'+i+'" class="active"></li>';
                    slider += '<div class="carousel-item active">';
                        slider += '<img src="'+data[i].img_item+'" alt="'+data[i].item_name+'">';
                        slider += '<div class="carousel-caption">';
                            slider += '<h3>'+data[i].item_name+'</h3>';
                        slider += '</div>';
                    slider += '</div>';
                } else {
                    indicator += '<li data-target="#demo" data-slide-to="'+i+'"></li>';
                    slider += '<div class="carousel-item">';
                        slider += '<img src="'+data[i].img_item+'" alt="'+data[i].item_name+'">';
                        slider += '<div class="carousel-caption">';
                            slider += '<h3>'+data[i].item_name+'</h3>';
                        slider += '</div>';
                    slider += '</div>';
                }
            }

            var html = '';
                html += '<ul class="carousel-indicators">';
                    html += indicator;
                html += '</ul>';
                html += '<div class="carousel-inner">';
                    html += slider;
                html += '</div>';
                html += '<a class="carousel-control-prev" href="#demo" data-slide="prev">';
                    html += '<span class="carousel-control-prev-icon"></span>';
                html += '</a>';
                html += '<a class="carousel-control-next" href="#demo" data-slide="next">';
                    html += '<span class="carousel-control-next-icon"></span>';
                html += '</a>';
            return html;
        }

        function renderListDOM(data) {
            var price = 'Rp'+parseInt(data.price_hour).toLocaleString(); 
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
            var linkURL = "{{ env('APP_API') }}/api/item/category.php";
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
            var linkURL = "{{ env('APP_API') }}/api/item/readPaging.php";
            $.post(linkURL+'?page=1', function(data) {
                if(!data.error){
                    var html = ''; var slider = '';
                    console.log(data.items.slice(0, 5));
                    slider += renderSliderDOM(data.items.slice(0, 5));
                    for(var i=5; i<10; i++) {
                        html += renderListDOM(data.items[i]);
                    }

                    $('#demo').html(slider);
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
