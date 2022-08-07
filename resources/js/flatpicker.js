import flatpickr from "flatpickr";

const datePickers = document.querySelectorAll('.date-picker');
datePickers.forEach(item => {
    flatpickr(item, {
        dateFormat: 'M j, Y',
        altInput: true,
        altFormat: 'Y-m-d',
        enableTime: false,
        onChange: function(selectedDate, config, instance) {
            // Close picker on date select
            instance.close();

            Alpine.store('bookingTimes').setDate(selectedDate);
        }
    });
});

const timePickers = document.querySelectorAll('.time-pickers');
timePickers.forEach(item => {
    flatpickr(item, {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
});
