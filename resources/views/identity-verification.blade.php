@extends('layouts.app')

@section('content')
<div class="container">
        <form action="{{ route('identity-verification') }}" class="form">
            <h5>KTP / SIM / Paspor</h5>
            <div class="form-group" style="text-align: left; font-size: 18px;">
                <label>Nomor Identitas</label>
                <input type="text" class="form-control" placeholder="Contoh: 354672xxxxxx" name="nomor-id">
            </div>
            <div class="form-group" style="text-align: left; font-size: 18px;">
                <label>Nama Sesuai Kartu</label>
                <input type="text" class="form-control" placeholder="Contoh: Rama Dwi Andika" name="nama">
            </div>
            <div class="form-group" style="text-align: left; font-size: 18px;">
                <label>Foto Kartu Identitas</label>
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="customFile" name="foto-kartu">
                    <label class="custom-file-label" for="customFile">Pilih File</label>
                </div>
            </div>

            <p style="text-align: left; color: red;">
                Data diri Anda sepenuhnya dilindungi oleh sistem kami dan akan menjadi rahasia
            </p>
            <a href="{{ route('account-verification') }}" style="padding: 8px; margin-right: 20px;" class="btn btn-danger btn-list">Batal</a>
            <button type="submit" class="btn btn-primary btn-list">Verifikasi</button>
        </form>
    </div>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection