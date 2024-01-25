@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <h4 class="card-title">Total Ruangan</h4>
                    <h3>{{$totalroom}}</h3>
                    <div class="progress mb-2">
                        <div class="progress-bar progress-animated bg-primary" style="width: 80%"></div>
                    </div>
                    <small>Total {{$totalroom}} Ruangan</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <h4 class="card-title">Total Pinjaman Bulan Ini</h4>
                    <h3>{{$pinjaman}}</h3>
                    <div class="progress mb-2">
                        <div class="progress-bar progress-animated bg-warning" style="width: 50%"></div>
                    </div>
                    <small>Ada {{$pinjaman}} Pinjaman di bulan ini</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <h4 class="card-title">Total Selesai Pinjam</h4>
                    <h3>{{$selesai}}</h3>
                    <div class="progress mb-2">
                        <div class="progress-bar progress-animated bg-red" style="width: 76%"></div>
                    </div>
                    <small>Total Seluruh Ruangan yang selesai dipinjam</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <h4 class="card-title">Ruangan di Pinjam</h4>
                    <h3>{{$ongoing}}</h3>
                    <div class="progress mb-2">
                        <div class="progress-bar progress-animated bg-success" style="width: 30%"></div>
                    </div>
                    <small>Ada total {{$ongoing}} ruangan yang sedang di booking</small>
                </div>
            </div>
        </div>
    </div>
    

</div>


@endsection