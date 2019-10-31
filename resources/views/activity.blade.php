@extends('layouts.app')

@section('content')
<div class="tab" style="top: 32px;">
    <button class="tablinks" onclick="openCity(event, 'Diproses')" id="defaultOpen">Sedang Diproses</button>
    <button class="tablinks" onclick="openCity(event, 'Selesai')">Selesai</button>
</div>

<div class="container" style="top: 30px;">
    <div id="Diproses" class="tabcontent">
        <div class="item-category list-for-rent">
            <a href="{{ route('tracking-order') }}" class="click-link">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="title-of-rent">Ahmad Ardiansyah Rental Motor</span>
                        <span class="status-rent" style="font-size: 12px;">Dipinjam</span>
                        <span class="date-of-rent" style="font-weight: bold">30 Sep 2019 11.06</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="item-category list-for-rent">
            <a href="{{ route('tracking-order') }}" class="click-link">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="title-of-rent">Stik Golf Harga Murah daerah Surabaya</span>
                        <span class="status-rent" style="font-size: 12px;">Dipinjam</span>
                        <span class="date-of-rent" style="font-weight: bold">30 Sep 2019 11.06</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="item-category list-for-rent">
            <a href="{{ route('tracking-order') }}" class="click-link">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="title-of-rent">Stik Golf Harga Murah daerah Surabaya</span>
                        <span class="status-rent" style="font-size: 12px;">Dipinjam</span>
                        <span class="date-of-rent" style="font-weight: bold">30 Sep 2019 11.06</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="item-category list-for-rent">
            <a href="{{ route('tracking-order') }}" class="click-link">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="title-of-rent">Stik Golf Harga Murah daerah Surabaya</span>
                        <span class="status-rent" style="font-size: 12px;">Dipinjam</span>
                        <span class="date-of-rent" style="font-weight: bold">30 Sep 2019 11.06</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div id="Selesai" class="tabcontent">
        <div class="item-category list-for-rent">
            <a href="{{ route('tracking-order') }}" class="click-link">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img2.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="title-of-rent">Stik Golf Harga Murah daerah Surabaya</span>
                        <span class="status-rent" style="font-size: 12px;">Dipinjam</span>
                        <span class="date-of-rent" style="font-weight: bold">30 Sep 2019 11.06</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="item-category list-for-rent">
            <a href="{{ route('tracking-order') }}" class="click-link">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img2.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="title-of-rent">Stik Golf Harga Murah daerah Surabaya</span>
                        <span class="status-rent" style="font-size: 12px;">Dipinjam</span>
                        <span class="date-of-rent" style="font-weight: bold">30 Sep 2019 11.06</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="item-category list-for-rent">
            <a href="{{ route('tracking-order') }}" class="click-link">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img2.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="title-of-rent">Stik Golf Harga Murah daerah Surabaya</span>
                        <span class="status-rent" style="font-size: 12px;">Dipinjam</span>
                        <span class="date-of-rent" style="font-weight: bold">30 Sep 2019 11.06</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<script>
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
    
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
@endsection
