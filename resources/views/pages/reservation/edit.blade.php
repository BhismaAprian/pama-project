@extends('layouts.master')

@section('content')
    @php
        $today = now()->format('Y-m-d');

    @endphp
    <div class="d-flex flex-row">
        <div class="col-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title text-center">Peminjaman Ruangan {{ $room->name }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('reservation.update', $room->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row form-material">
                            @auth
                                <div class="col-xl-6 col-xxl-12 col-md-12 mb-3">
                                    <label>Nama Peminjam</label>
                                    <input type="text" id="user" name="user_id" class="form-control"
                                        value="{{ Auth()->user()->name }}" readonly>
                                </div>
                            @else
                                <div class="col-xl-6 col-xxl-12 col-md-12 mb-3">
                                    <label class="align-items-center">Nama Peminjam</label>
                                    <input type="text" id="user" name="guest" class="form-control"
                                        placeholder="Masukkan Nama Peminjam">
                                </div>
                            @endauth
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label>Mulai Tanggal Pinjam</label>
                                <input name="reservation_start" id="start_date" class="form-control"
                                    placeholder="2017-06-04" id="mdate" required>
                            </div>
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <label>Selesai Tanggal Pinjam</label>
                                <input name="reservation_end" class="   form-control" id="end_date" required>

                            </div>
                            <div class="col-xl-6 col-xxl-12 col-md-12 mb-3">
                                <label>Barang Pinjaman</label>

                                <select multiple="" id="objekSelect[]" class="form-control default-select" name="objekSelect[]"
                                    onchange="createQtyForms()">
                                    <option value="">Pilih Salahsatu atau Lebih Barang Yang akan dipinjam</option>
                                    @foreach ($barangSedia as $barang)
                                        <option value="{{ $barang->id }}" id="{{$barang->name}}" class="{{$barang->qty_sedia}}">{{ $barang->name }}</option>
                                    @endforeach
                                    {{-- <option value="objek1">Objek 1</option>
                                    <option value="objek2">Objek 2</option>
                                    <option value="objek3">Objek 3</option> --}}
                                </select>
                            </div>
                            {{-- <input type="number" name="quantity" id="quantity" oninput="this.value = Math.max(1, Math.min(5, this.value))"> --}}
                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                <div id="qtyFormsContainer"></div>
                            </div>
                            <div class="col-xl-6 col-xxl-12 col-md-12 mb-3">
                                <label>Catatan</label>
                                <textarea class="form-control" name="description" rows="4" id="comment"></textarea>
                            </div>
                            <div class="col-xl-3">
                                <button type="submit" class="btn light btn-primary btn-lg">Submit</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Info Ruangan</h4>
                </div>
                <div class="card-body">
                    <img class="rounded" src="{{ asset('storage/thumbnails/' . $room->thumbnail) }}"
                        style="height: 250px; width:330px;" alt="">
                    <div class="text-black fs-18 font-w500 mt-2">{{ $room->name }}</div>
                    <p class="fs-10 font-w400">{{ $room->description }}</p>
                    <div class="table-responsive">
                        <table class="table header-border table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Peminjam</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($history as $rooms)
                                    <tr>
                                        <td>{{ $rooms->user->name ?? $rooms->guest }}</td>
                                        <td>
                                            @if ($rooms->reservation_start <= $today && $rooms->reservation_end >= $today)
                                                <span class="badge light badge-secondary">Pending</span>
                                            @elseif ($rooms->reservation_start <= $today && $rooms->reservation_end < $today)
                                                <span class="badge light badge-warning">Kadaluarsa</span>
                                            @else
                                                <span class="badge light badge-success">Selesai</span>
                                            @endif
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var reservedDates = [
                @foreach ($room->roomReservation as $reservation)
                    {
                        start: '{{ \Carbon\Carbon::parse($reservation->reservation_start)->format('Y-m-d') }}',
                        end: '{{ \Carbon\Carbon::parse($reservation->reservation_end)->format('Y-m-d') }}'
                    },
                @endforeach
            ];

            flatpickr("#start_date", {
                dateFormat: 'Y-m-d',
                disable: reservedDates.map(dateRange => ({
                    from: dateRange.start,
                    to: dateRange.end
                })),
                onClose: function(selectedDates, dateStr, instance) {
                    if (instance.input.id === 'start_date') {
                        var endDatePicker = flatpickr("#end_date");
                        endDatePicker.set('minDate', selectedDates[0]);
                    }
                }
            });

            flatpickr("#end_date", {
                dateFormat: 'Y-m-d',
                onClose: function(selectedDates, dateStr, instance) {
                    // Update the start_date maximum date when end_date is selected
                    if (instance.input.id === 'end_date') {
                        var startDatePicker = flatpickr("#start_date");
                        startDatePicker.set('maxDate', selectedDates[0]);
                    }
                }
            });
        });

        // function createQtyForms() {
        //     var selectValues = Array.from(document.getElementById("objekSelect").selectedOptions).map(option => option
        //         .value);
        //     var qtyFormsContainer = document.getElementById("qtyFormsContainer");
        //     qtyFormsContainer.innerHTML = ""; // Clear existing forms

        //     selectValues.forEach(function(selectValue) {
        //         var objekCount = parseInt(selectValue.match(/\d+/)[0]); // Extract number from objek value
        //         var formGroup, i;
        //         formGroup = document.createElement("div");
        //         formGroup.classList.add("form-group");
        //         formGroup.innerHTML = `
        //         <label for="qty${selectValue}">Tentukan Jumlah Pinjaman ${selectValue}:</label>
        //         <input class="form-control" type="number" id="qty${selectValue}" name="qty${selectValue}" required>
        //     `;
        //         qtyFormsContainer.appendChild(formGroup);
        //     });
        // }
        function createQtyForms() {
    var selectOptions = Array.from(document.getElementById("objekSelect[]").selectedOptions);
    var qtyFormsContainer = document.getElementById("qtyFormsContainer");
    qtyFormsContainer.innerHTML = ""; // Clear existing forms

    selectOptions.forEach(function(option) {
        
        var selectValue = option.value;
         // Ambil nilai dari atribut value
        var objekId = option.id;
        var objekClass = option.getAttribute("class");
        var objekCount = parseInt(selectValue.match(/\d+/)[0]); // Extract number from objek value
        var formGroup = document.createElement("div");
        formGroup.classList.add("form-group");
        formGroup.innerHTML = `
            <label for="qty${objekId}">Tentukan Jumlah Pinjaman ${objekId}:</label>
            <input class="form-control" type="number" id="qty${objekId}" name="qty" placeholder="Hanya ${objekClass} barang yang tersedia" oninput="this.value = Math.max(1, Math.min(${objekClass}, this.value))" required>
        `;
        qtyFormsContainer.appendChild(formGroup);
    });
}
    </script>
@endpush
