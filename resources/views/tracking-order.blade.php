@extends('layouts.app')

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
            <div class="item-category list-for-rent">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="desc" style="font-weight: bold;">Hitam Putih Store</span>
                        <span class="desc">Bola Golf</span>
                        <span class="desc">Rp. 50.000 x 1 item</span>
                        <span class="desc">25-09-2019 s/d 25-10-2019</span>
                        <span class="desc" style="color: red;">Belum Bayar</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col col-sm-6" style="font-size: 16px; font-weight: bold;">
                        Total: Rp. 50.000
                    </div>
                    <div class="col col-sm-6" style="text-align: right;">
                        <button class="btn btn-sm btn-primary">Upload</button>
                    </div>
                </div>
            </div>
            <div class="item-category list-for-rent">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="desc" style="font-weight: bold;">Hitam Putih Store</span>
                        <span class="desc">Bola Golf</span>
                        <span class="desc">Rp. 50.000 x 1 item</span>
                        <span class="desc">25-09-2019 s/d 25-10-2019</span>
                        <span class="desc" style="color: red;">Belum Bayar</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col col-sm-6" style="font-size: 16px; font-weight: bold;">
                        Total: Rp. 50.000
                    </div>
                    <div class="col col-sm-6" style="text-align: right;">
                        <button class="btn btn-sm btn-primary">Upload</button>
                    </div>
                </div>
            </div>
            <div class="item-category list-for-rent">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="desc" style="font-weight: bold;">Hitam Putih Store</span>
                        <span class="desc">Bola Golf</span>
                        <span class="desc">Rp. 50.000 x 1 item</span>
                        <span class="desc">25-09-2019 s/d 25-10-2019</span>
                        <span class="desc" style="color: red;">Belum Bayar</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col col-sm-6" style="font-size: 16px; font-weight: bold;">
                        Total: Rp. 50.000
                    </div>
                    <div class="col col-sm-6" style="text-align: right;">
                        <button class="btn btn-sm btn-primary">Upload</button>
                    </div>
                </div>
            </div>
            
        </div>

        <div id="Dikonfimasi" class="tabcontent">
            <div class="item-category list-for-rent">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="desc" style="font-weight: bold;">Hitam Putih Store</span>
                        <span class="desc">Bola Golf</span>
                        <span class="desc">Rp. 50.000 x 1 item</span>
                        <span class="desc">25-09-2019 s/d 25-10-2019</span>
                        <span class="desc" style="color: red;">Perlu Dikirim</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col col-sm-6" style="font-size: 16px; font-weight: bold;">
                        Total: Rp. 50.000
                    </div>
                    <div class="col col-sm-6" style="text-align: right;">
                        <button class="btn btn-sm btn-primary">Upload</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="Dikirim" class="tabcontent">
            <div class="item-category list-for-rent">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="desc" style="font-weight: bold;">Hitam Putih Store</span>
                        <span class="desc">Bola Golf</span>
                        <span class="desc">Rp. 50.000 x 1 item</span>
                        <span class="desc">25-09-2019 s/d 25-10-2019</span>
                        <span class="desc" style="color: red;">Dikirm</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col col-sm-6" style="font-size: 16px; font-weight: bold;">
                        Total: Rp. 50.000
                    </div>
                    <div class="col col-sm-6" style="text-align: right;">
                        <button class="btn btn-sm btn-primary">Diterima</button>
                    </div>
                </div>
            </div>
            <div class="item-category list-for-rent">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="desc" style="font-weight: bold;">Hitam Putih Store</span>
                        <span class="desc">Bola Golf</span>
                        <span class="desc">Rp. 50.000 x 1 item</span>
                        <span class="desc">25-09-2019 s/d 25-10-2019</span>
                        <span class="desc" style="color: red;">Dikirm</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col col-sm-6" style="font-size: 16px; font-weight: bold;">
                        Total: Rp. 50.000
                    </div>
                    <div class="col col-sm-6" style="text-align: right;">
                        <button class="btn btn-sm btn-primary">Diterima</button>
                    </div>
                </div>
            </div>
            <div class="item-category list-for-rent">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="desc" style="font-weight: bold;">Hitam Putih Store</span>
                        <span class="desc">Bola Golf</span>
                        <span class="desc">Rp. 50.000 x 1 item</span>
                        <span class="desc">25-09-2019 s/d 25-10-2019</span>
                        <span class="desc" style="color: red;">Dikirm</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col col-sm-6" style="font-size: 16px; font-weight: bold;">
                        Total: Rp. 50.000
                    </div>
                    <div class="col col-sm-6" style="text-align: right;">
                        <button class="btn btn-sm btn-primary">Diterima</button>
                    </div>
                </div>
            </div>
            
        </div>

        <div id="Dipinjam" class="tabcontent">
            <div class="item-category list-for-rent">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="desc" style="font-weight: bold;">Hitam Putih Store</span>
                        <span class="desc">Bola Golf</span>
                        <span class="desc">Rp. 50.000 x 1 item</span>
                        <span class="desc">25-09-2019 s/d 25-10-2019</span>
                        <span class="desc" style="color: red;">Dipinjam</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col col-sm-6" style="font-size: 16px; font-weight: bold;">
                        Total: Rp. 50.000
                    </div>
                </div>
            </div>
            
            
        </div>

        <div id="Selesai" class="tabcontent">
            <div class="item-category list-for-rent">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="desc" style="font-weight: bold;">Hitam Putih Store</span>
                        <span class="desc">Bola Golf</span>
                        <span class="desc">Rp. 50.000 x 1 item</span>
                        <span class="desc">25-09-2019 s/d 25-10-2019</span>
                        <span class="desc" style="color: red;">Selesai</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col col-sm-6" style="font-size: 16px; font-weight: bold;">
                        Total: Rp. 50.000
                    </div>
                </div>
            </div>
                
                
        </div>

        <div id="Batal" class="tabcontent">
            <div class="item-category list-for-rent">
                    <div class="one-list-for-rent">
                        <figure class="pic-for-rent">
                            <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                        </figure>
                        <div class="desc-for-rent">
                            <span class="desc" style="font-weight: bold;">Hitam Putih Store</span>
                            <span class="desc">Bola Golf</span>
                            <span class="desc">Rp. 50.000 x 1 item</span>
                            <span class="desc">25-09-2019 s/d 25-10-2019</span>
                            <span class="desc" style="color: red;">Batal</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col col-sm-6" style="font-size: 16px; font-weight: bold;">
                            Total: Rp. 50.000
                        </div>
                    </div>
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
