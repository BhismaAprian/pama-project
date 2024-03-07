@extends('layouts.master')

@section('content')
    @if (session('toastr-success'))
        <script src="{{ asset('vendor/toastr/js/toastr.min.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.success("{{ session('toastr-success') }}", 'Success', {
                    positionClass: 'toast-top-right'
                });
            });
        </script>
    @endif
    <div class="container-fluid">
        <div class="form-head d-flex align-items-center flex-wrap mb-sm-5 mb-3">
            <h2 class="font-w600 mb-0 text-black">Fasilitas Management</h2>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Buat Barang</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('attributes.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control" placeholder="Nama Barang">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jumlah</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="qty" class="form-control"
                                            placeholder="Masukkan Jumlah">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Deskripsi Barang</label>
                                    <textarea class="form-control" name="description" rows="4" id="comment"></textarea>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit"
                                            class="btn btn-primary d-flex align-items-end">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="col-xl-12">
                        <div class="table-responsive table-hover fs-14">
                            <table class="table display mb-4 dataTablesCard short-one card-table text-black" id="example3">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Attribut</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attributes as $attribute)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $attribute->name }}</td>
                                            <td class="wspace-no">
                                                <span class="text-black">{{ $attribute->qty }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex action-button">
                                                    <a href="{{ route('attributes.edit', $attribute->id) }}"
                                                        class="btn btn-info btn-xs light px-2">
                                                        <svg width="20" height="20" viewbox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z"
                                                                stroke="#fff" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <button onclick="deleteRoom({{ $attribute->id }})"
                                                        class="ml-2 btn btn-xs px-2 light btn-danger">
                                                        <svg width="20" height="20" viewbox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3 6H5H21" stroke="#fff" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path
                                                                d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z"
                                                                stroke="#fff" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                        </svg>

                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
