@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="form-head d-flex align-items-center flex-wrap mb-sm-5 mb-3">
            <h2 class="font-w600 mb-0 text-black">Room Management</h2>
            <a href="{{ route('rooms.create') }}" class="btn btn-outline-secondary ml-auto"><i
                    class="las la-calendar scale5 mr-2"></i>Buat Room</a>
        </div>
        <div class="row">
            <div class="col-xl-6 col-xxl-6 col-lg-8 col-sm-9">
                <div class="widget-stat card bg-primary">
                    <div class="card-body  p-4">
                        <div class="media">
                            <span class="mr-3">
                                <i class="la la-users"></i>
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">Total Ruangan</p>
                                <h3 class="text-white">{{ $room->count() }}</h3>
                                <small>Dari Keseluruhan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xxl-6 col-lg-8 col-sm-9">
                <div class="widget-stat card bg-primary">
                    <div class="card-body  p-4">
                        <div class="media">
                            <span class="mr-3">
                                <i class="la la-users"></i>
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">Riwayat Peminjaman</p>
                                <h3 class="text-white">{{ $roomTersedia }}</h3>
                                <div class="progress mb-2 bg-secondary">
                                    <div class="progress-bar progress-animated bg-light"
                                        style="width: {{ $roomTersedia }}%"></div>
                                </div>
                                <small>Riwayat Ruangan</small>
                            </div>
                        </div>
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
                                    <th>Thumbnail</th>
                                    <th>Nama Ruangan</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($room as $rooms)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/thumbnails/' . $rooms->thumbnail) }}"
                                                    class="rounded width36 height36" style="height: 80px; width: 120px"
                                                    alt="">
                                            </div>
                                        </td>
                                        <td>{{ $rooms->name }}</td>

                                        <td>
                                            {{ $rooms->description }}
                                        </td>
                                        <td>
                                            <div class="d-flex action-button">
                                                <a href="{{ route('rooms.edit', $rooms->id) }}"
                                                    class="btn btn-info btn-xs light px-2">
                                                    <svg width="20" height="20" viewbox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z"
                                                            stroke="#fff" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg>
                                                </a>
                                                <button onclick="deleteRoom({{ $rooms->id }})"
                                                    class="ml-2 btn btn-xs px-2 light btn-danger">
                                                    <svg width="20" height="20" viewbox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
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
    
@endsection
@push('add-script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteRoom(id) {
            // Menampilkan SweetAlert2 dengan pilihan "Ya" dan "Tidak"
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna memilih "Ya", lakukan penghapusan menggunakan Ajax
                    $.ajax({
                        url: 'rooms/' + id,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            // Menampilkan SweetAlert2 jika penghapusan berhasil
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: 'Ruangan berhasil dihapus!',
                            }).then(() => {
                                // Lakukan redirect atau perbarui halaman jika diperlukan
                                location.reload();
                            });
                        },
                        error: function(error) {
                            // Menampilkan SweetAlert2 jika terjadi kesalahan
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan saat menghapus ruangan.',
                            });
                        }
                    });
                }
            });
        }
    </script>
    
@endpush
