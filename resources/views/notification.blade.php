@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/activity.css') }}">
@endsection

@section('content')
<div class="tab" style="top: 32px;">
    <button class="tablinks" onclick="openCity(event, 'Diproses')" id="defaultOpen">PESAN</button>
    <button class="tablinks" onclick="openCity(event, 'Selesai')">NOTIFIKASI</button>
</div>

<div class="container" style="top: 30px;">
    <div id="Diproses" class="tabcontent">
        <span>loading...</span>
    </div>

    <div id="Selesai" class="tabcontent">
        <span>loading...</span>
    </div>
</div>
@endsection

@section('js')
<script>
    var userInfo = localStorage.getItem('user');
    var user = JSON.parse(userInfo);

    function renderDOM(data) {
        var html = '';
        html += '<div class="item-category list-for-rent">';
            html += '<a href="#" class="click-link">';
                html += '<div class="one-list-for-rent">';
                    html += '<figure class="pic-for-rent">';
                        html += '<img src="{{ asset('tema/img/img2.jpg') }}" class="">';
                    html += '</figure>';
                    html += '<div class="desc-for-rent">';
                        html += '<span class="title-of-rent">Stik Golf Harga Murah daerah Surabaya</span>';
                        html += '<span class="status-rent" style="font-size: 12px;">Dipinjam</span>';
                        html += '<span class="date-of-rent" style="font-weight: bold">30 Sep 2019 11.06</span>';
                    html += '</div>';
                html += '</div>';
            html += '</a>';
        html += '</div>';
        return html;
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
        if(userInfo == null) {
            window.location.href = "{{ route('login') }}";
        } else {

        }
    })
</script>
@endsection
