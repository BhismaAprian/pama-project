@extends('layouts.master')

@section('content')
    @if (session('sweet-success'))
        <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('js/plugins-init/sweetalert.init.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Sweet Success!',
                    text: "{{ session('sweet-success') }}",
                    icon: 'success',
                    confirmButtonColor: '#28a745',
                });
            });
        </script>
    @endif
    <div class="m-2 row">
        @foreach ($room as $rooms)
            @php

                $reservation = DB::table('room_reservations')
                    ->where('room_id', $rooms->id)
                    ->first();
                // Assuming you want to check the first reservation
                $today = \Carbon\Carbon::now()->format('Y-m-d');

            @endphp
            <div class="col-xl-3">
                <div class="card border-0 mb-3">
                    <div class="new-arrivals-img-contnent">
                        <img class="card-img-top img-fluid" style="height: 150px; width:400px;"
                            src="{{ asset('storage/thumbnails/' . $rooms->thumbnail) }}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row card-text">

                            <div class="d-flex flex-column">
                                <p class="fw-semibold">{{ $rooms->name }}</p>

                            </div>
                            <div class="col"></div>
                            <div class="d-flex flex-column">
                                <span class="fw-light badge badge-dark light">AULA</span>
                            </div>
                        </div>
                        <div class="card-text row">
                            <div class="col-4">
                                @if ($rooms->roomReservation->isNotEmpty())
                                    @php
                                        $isAvailable = true;
                                        foreach ($rooms->roomReservation as $reservation) {
                                            if ($reservation->reservation_start <= $today && $reservation->reservation_end >= $today) {
                                                $isAvailable = false;
                                                break;
                                            }
                                        }
                                    @endphp

                                    @if ($isAvailable)
                                        <span class="badge badge-success light">TERSEDIA HARI INI</span>
                                    @else
                                        <span class="badge badge-warning light">TIDAK TERSEDIA HARI INI</span>
                                    @endif
                                @else
                                    <span class="badge badge-success light">TERSEDIA HARI INI</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-text d-flex flex-row mt-1">
                            @if ($reservation && $reservation->reservation_start && $reservation->reservation_end)
                                @if ($reservation->reservation_start <= $today && $reservation->reservation_end >= $today)
                                    <a type="button" href="{{ route('reservation.edit', $rooms->id) }}"
                                        class="btn btn-warning p-2 mt-2 float-center">Pinjam
                                        Nanti</a>
                                @else
                                    <a type="button" href="{{ route('reservation.edit', $rooms->id) }}"
                                        class="btn btn-primary p-2 mt-2 float-center">Pinjam Sekarang</a>
                                @endif
                            @else
                                <a type="button" href="{{ route('reservation.edit', $rooms->id) }}"
                                    class="btn btn-primary p-2 mt-2 float-center ">Pinjam Sekarang</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row">
                            <img style="height: 20px;" class="mb-2"
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAXElEQVR4nO2VwQoAIAhD/f+fXpeuUbGZLHzgIQh5NMOIpjkDs7LuLxuoy09AFQEtwOIbAaoFVPwngM2Up/8CVAvc4i8A8dlPgMVfAOQT+wuw+Aqgeh2jSqBp4hUDGJPzDe3ClcEAAAAASUVORK5CYII=">
                            <div class="d-flex flex-row">
                                {{-- <a href="javascript:void(0);" class="btn btn-primary mb-3">Card link</a> --}}
                                <p class="fs-12">
                                    {{ DB::table('room_reservations')->where('room_id', $rooms->id)->count() }}x Dipinjam
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
