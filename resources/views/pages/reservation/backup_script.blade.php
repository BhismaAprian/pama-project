// document.addEventListener('DOMContentLoaded', function () {
    //     var reservedDates = [
    //         { start: '2024-01-26', end: '2024-01-26' },
    //         // Add more reservations as needed
    //     ];

    //     flatpickr("#start_date", {
    //         dateFormat: 'Y-m-d',
    //         disable: reservedDates.map(date => ({ from: date.start, to: date.end })),
    //         onClose: function(selectedDates, dateStr, instance) {

    //             if (instance.input.id === 'start_date') {
    //                 var endDatePicker = flatpickr("#end_date");
    //                 endDatePicker.set('minDate', selectedDates[0]);
    //             }
    //         }
    //     });

    //     flatpickr("#end_date", {    
    //         dateFormat: 'Y-m-d',
    //         onClose: function(selectedDates, dateStr, instance) {
    //             // Update the start_date maximum date when end_date is selected
    //             if (instance.input.id === 'end_date') {
    //                 var startDatePicker = flatpickr("#start_date");
    //                 startDatePicker.set('maxDate', selectedDates[0]);
    //             }
    //         }
    //     });
    // });

    document.addEventListener('DOMContentLoaded', function() {
        var reservedstartDates = [
            @foreach ($room->roomReservation as $reservation)
                '{{ \Carbon\Carbon::parse($reservation->reservation_start)->format('Y-m-d') }}',
            @endforeach
        ];

        var reservedendDates = [
            @foreach ($room->roomReservation as $reservation)
                '{{ \Carbon\Carbon::parse($reservation->reservation_end)->format('Y-m-d') }}',
            @endforeach
        ];
        flatpickr("#start_date", {
            dateFormat: 'Y-m-d',
            disable: reservedstartDates.map(date => date),
            onClose: function(selectedDates, dateStr, instance) {
                if (instance.input.id === 'start_date') {
                    var endDatePicker = flatpickr("#end_date");
                    endDatePicker.set('minDate', selectedDates[0]);
                }
            }
        });

        flatpickr("#end_date", {
            dateFormat: 'Y-m-d',
            disable: reservedendDates.map(date => date),
            onClose: function(selectedDates, dateStr, instance) {
                // Update the start_date maximum date when end_date is selected
                if (instance.input.id === 'end_date') {
                    var startDatePicker = flatpickr("#start_date");
                    startDatePicker.set('maxDate', selectedDates[0]);
                }
            }
        });
    });




    SCRIPT BERHASIL

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