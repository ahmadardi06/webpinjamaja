@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $message }}</div>

                <div class="card-body">
                    <b>{{ Auth::user()->level }}</b>
                    Sekarang nyuapin aku.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
