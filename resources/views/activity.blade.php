@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('tema/css/activity.css') }}">
@endsection

@section('content')
<div class="tab" style="top: 32px;">
    <button class="tablinks" onclick="openCity(event, 'Diproses')" id="defaultOpen">Sedang Diproses</button>
    <button class="tablinks" onclick="openCity(event, 'Selesai')">Selesai</button>
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
    function tglIndo(date) {
        var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        var bulan = ['Januari', 'Februari', 'Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        var tanggal = new Date(date).getDate();
        var xhari = new Date(date).getDay();
        var xbulan = new Date(date).getMonth();
        var xtahun = new Date(date).getYear();
        var hari = hari[xhari];
        var bulan = bulan[xbulan];
        var tahun = (xtahun < 1000)?xtahun + 1900 : xtahun;

        return hari +', ' + tanggal + ' ' + bulan + ' ' + tahun;
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
    
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();

    function renderDOM(data){
        var price = 'Rp'+parseInt(data.order_total).toLocaleString(); 
        var tgl = tglIndo(data.date_transaction_end);
        var html = '';
        html += '<div class="item-category list-for-rent">';
            html += '<a href="#" class="click-link">';
                html += '<div class="one-list-for-rent">';
                    html += '<figure class="pic-for-rent">';
                        html += '<img src="'+data.items.img_item+'" class="">';
                    html += '</figure>';
                    html += '<div class="desc-for-rent">';
                        html += '<span class="title-of-rent">'+data.items.item_name+'</span>';
                        html += '<span class="">'+price+'</span>';
                        html += '<span class="status-rent" style="font-size: 12px;">'+data.status_order+'</span>';
                        html += '<span class="date-of-rent" style="font-weight: bold">'+tgl+'</span>';
                    html += '</div>';
                html += '</div>';
            html += '</a>';
        html += '</div>';
        return html;
    }

    var userInfo = localStorage.getItem('user');
    var user = JSON.parse(userInfo);

    $(function(){
        var linkDiProses = "{{ env('APP_API') }}/api/transaction/user/orderActivity.php";
        var formDataProses = {id_user: user.id_user, status_order: 'diproses'};
        var formDataSelesai = {id_user: user.id_user, status_order: 'selesai'};

        $.post(linkDiProses, formDataProses, function(data){
            console.log('proses: ', data)
            if(!data.error){
                var html = '';
                for(var i=0; i<data.transactions.length; i++){
                    html += renderDOM(data.transactions[i]);
                }
                $('#Diproses').html(html);
            }
        })

        $.post(linkDiProses, formDataSelesai, function(data){
            console.log('selesai: ', data)
            if(!data.error){
                var html = '';
                for(var i=0; i<data.transactions.length; i++){
                    html += renderDOM(data.transactions[i]);
                }
                $('#Selesai').html(html);
            }
        })
    })
</script>
@endsection
