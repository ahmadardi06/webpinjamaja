@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
@endsection

@section('content')
    <div class="tab">
        <div class="title-page" >List Item</div>
        <button class="tablinks" data-toggle="modal" data-target="#myModal">
            Filter
        </button>
    </div>

    <div class="container">
        <div class="item-category list-for-rent">
            <a href="{{ route('detail-product') }}" class="click-link">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="title-of-rent">Stik Golf Harga Murah daerah Surabaya</span>
                        <span style="font-size: 12px;">Rama Store1</span>
                        <span style="font-size: 18px; font-weight: bold">Rp. 30.000</span>
                        <button class="btn btn-sm btn-primary">Pinjam Sekarang</button>
                    </div>
                </div>
            </a>
        </div>
        <div class="item-category list-for-rent">
            <a href="{{ route('detail-product') }}" class="click-link">
                <div class="one-list-for-rent">
                    <figure class="pic-for-rent">
                        <img src="{{ asset('tema/img/img1.jpg') }}" class="">
                    </figure>
                    <div class="desc-for-rent">
                        <span class="title-of-rent">Stik Golf</span>
                        <span style="font-size: 12px;">Rama Store1</span>
                        <span style="font-size: 18px; font-weight: bold">Rp. 30.000</span>
                        <button class="btn btn-sm btn-primary">Pinjam Sekarang</button>
                    </div>
                </div>
            </a>
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
        $('.tgl').datepicker({
            format: 'dd-mm-yyyy'
            }).on('hide', function(event) {
                event.preventDefault();
                event.stopPropagation();
        });
    </script>

@endsection