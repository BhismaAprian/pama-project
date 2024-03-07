@extends('layouts.master')

@section('content')
@php
                    $today = \Carbon\Carbon::now()->timezone('asia/makassar');

@endphp

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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">History Pinjaman</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama Ruangan</th>
                                <th>Peminjam</th>
                                <th>Mulai Pinjam</th>
                                <th>Selesai Pinjam</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                @auth
                                <th>Action</th>

                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $room)
                                <tr>
                                    <td><img class="rounded" width="50"
                                            src="{{ asset('storage/thumbnails/' . $room->room->thumbnail) }}" alt="">
                                    </td>
                                    <td>{{ $room->room->name }}</td>
                                    <td>{{ $room->user->name ?? $room->guest }}</td>
                                    <td>{{ \Carbon\Carbon::parse($room->reservation_start)->format('Y M d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($room->reservation_end)->format('Y M d') }}</td>
                                    <td><strong>{{ $room->description }}</strong></td>
                                    
                                    <td>
                                        @if ($room->reservation_start <= $today && $room->reservation_end >= $today)
                                        <span class="badge light badge-secondary">Dipinjam</span>
                                        @elseif ($room->reservation_start <= $today && $room->reservation_end < $today)
                                        <span class="badge light badge-warning">Kadaluarsa</span>
                                        @else
                                        <span class="badge light badge-success">Selesai</span>
                                        @endif
                                    </td>
                                    @auth
                                    <td>
                                        <div class="d-flex">
                                            <button onclick="deleteRoom({{ $room->id }})" class="btn btn-danger shadow btn-xs sharp"><i
                                                    class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                    @endauth
                                    

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</div>


@endsection