@extends('layouts.master')


@section('content')
@php
                $today = \Carbon\Carbon::now()->timezone('asia/makassar');

@endphp
    <div class="col-12">
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
                        url: '/history/' + id,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            // Menampilkan SweetAlert2 jika penghapusan berhasil
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: 'Riwayat berhasil dihapus!',
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
                                text: 'Terjadi kesalahan saat menghapus riwayat.',
                            });
                        }
                    });
                }
            });
        }
    </script>
    
@endpush

