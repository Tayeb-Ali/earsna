import './bootstrap';
import './flatpicker';

import Alpine from 'alpinejs';
import jQuery from 'jquery-slim';
import axios from 'axios';

window.Alpine = Alpine;
window.$ = window.jQuery = jQuery;
Alpine.start();

window.onload = () => {
    const value = $('#bookingTimePrice').val();
    const offers = document.querySelectorAll('.offer');

    if (value) {
        Alpine.store('payment').setBookingTime(value, false);
    }

    if (offers) {
        offers.forEach(offer => {
            if (offer.hasAttribute('checked')) {
                let price = $(offer).parents('tr').find('input.offer-price').val();

                Alpine.store('payment').setOffer(price, false);
            }
        })
    }
}

Alpine.store('selection', {
    select(target, value) {
        let inputs = target.parentElement.parentElement.querySelectorAll('input')

        inputs[0].value = target.textContent.trim();

        inputs[1].value = value;
    },

    check(el, resource) {
        const resources = document.querySelectorAll('.' + resource);

        if (el.checked === true) {
            resources.forEach(item => {
                item.checked = true;
            })
        } else {
            resources.forEach(item => {
                item.checked = false;
            })
        }
    },

    period() {
        // area where times will be inserted
        const bookingTimes = $('#bookingTimes tbody');

        // number of inserted times
        let counter = bookingTimes.children().length;

        // new time values
        const periodDisplayValue = $('#period input')[0].value;
        const periodsendValue = $('#period input')[1].value;
        const from = $('#from').val();
        const to = $('#to').val();
        const price = $('#price').val();

        let time = `
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-slate-500">
                        ${periodDisplayValue}
                        <input type="hidden" name="bookingTimes[${counter}][period]" value="${periodsendValue}" >
                    </div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-slate-500">
                        ${from}
                        <input type="hidden" name="bookingTimes[${counter}][from]" value="${from}">
                    </div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-slate-500">
                        ${to}
                        <input type="hidden" name="bookingTimes[${counter}][to]" value="${to}">
                    </div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-slate-500">
                        ${price}
                        <input type="hidden" name="bookingTimes[${counter}][price]" value="${price}">
                    </div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                    <button @click.prevent="$el.parentElement.parentElement.remove()" class="text-red-400 hover:text-red-500 py-2 px-4 transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </button>
                <td>
            </tr>
        `;

        bookingTimes.append(time);
    },
});

Alpine.store('bookingTimes', {
    date: '',
    period: '',

    setDate(date) {
        this.date = date;
    },

    setPeriod(period) {
        this.period = period;
    },

    fetch(hall) {
        const bookingTimes = $('#availableBookingTimes tbody');
        const noBookingTimes = $('#noBookingTimes');

        axios.get(`/halls/${hall}/available-booking-times`, {
            params: {
                date: new Date(this.date[0]).toDateString(),
                period: this.period
            }
        })
            .then(response => {
                if (response.data.no_times) {
                    noBookingTimes.append(response.data.no_times);
                } else {
                    noBookingTimes.textContent = '';

                    if (!Array.isArray(response.data.times)) {
                        const time = response.data.times[1];

                        let row = `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-500">
                                        <input
                                            name="bookingTime_id" value="${time.id}" type="radio"
                                            @click="$store.payment.setBookingTime(${time.price}, true)"
                                            class="focus:ring-slate-600 h-4 w-4 text-slate-800 border-gray-300 cursor-pointer"
                                        >
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-500">
                                        ${time.from}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-500">
                                        ${time.to}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="booking-time-price text-sm text-slate-500">
                                        ${time.price}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-500"></div>
                                </td>
                            </tr>
                        `;

                        bookingTimes.append(row);
                    } else {
                        response.data.times.forEach(time => {
                            let row = `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-500">
                                        <input
                                            name="bookingTime_id" value="${time.id}" type="radio"
                                            @click="$store.payment.setBookingTime(${time.price}, true)"
                                            class="focus:ring-slate-600 h-4 w-4 text-slate-800 border-gray-300 cursor-pointer"
                                        >
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-500">
                                        ${time.from}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-500">
                                        ${time.to}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="booking-time-price text-sm text-slate-500">
                                        ${time.price}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-500"></div>
                                </td>
                            </tr>
                        `;

                            bookingTimes.append(row);
                        });
                    }
                }
            })
            .catch(errors => {
                console.log(errors);
            })
    },
});

Alpine.store('halls', {
    add() {
        // area where halls will be inserted
        const halls = $('#halls tbody');

        // number of inserted halls
        let counter = halls.children().length;

        // new hall values
        const name = $('#hallName').val();
        const cityDisplayValue = $('#hallCity input')[0].value;
        const citySendValue = $('#hallCity input')[1].value;
        const address = $('#address').val();
        const capacity = $('#capacity').val();

        let hall = `
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-slate-500">
                        ${name}
                        <input type="hidden" name="halls[${counter}][name]" value="${name}">
                    </div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-slate-500">
                        ${cityDisplayValue}
                        <input type="hidden" name="halls[${counter}][city]" value="${citySendValue}">
                    </div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-slate-500">
                        ${address}
                        <input type="hidden" name="halls[${counter}][address]" value="${address}">
                    </div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-slate-500">
                        ${capacity}
                        <input type="hidden" name="halls[${counter}][capacity]" value="${capacity}">
                    </div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                    <button @click.prevent="$el.parentElement.parentElement.remove()" class="text-red-400 hover:text-red-500 py-2 px-4 transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </button>
                <td>
            </tr>
        `;

        halls.append(hall);
    }
})

Alpine.store('payment', {
    bookingTime: 0,
    offer: 0,
    service: 0,
    remaining: 0,
    total: 0,

    setBookingTime(value, updateTotalInput = false) {
        this.bookingTime = parseFloat(value);

        this.setTotal(updateTotalInput)
    },

    getBookingTime() {
        return this.bookingTime;
    },

    setOffer(value, updateTotalInput = false) {
        this.offer = parseFloat(value);

        this.setTotal(updateTotalInput)
    },

    getOffer() {
        return this.offer;
    },

    setService(value, updateTotalInput = false) {
        this.service = parseFloat(value);

        this.setTotal(updateTotalInput)
    },

    getService() {
        return this.offer;
    },

    setRemaining(value) {
        let result = this.total - parseFloat(value);

        this.remaining = result > 0 ? result : 0

        this.updateRemainingInput(this.remaining);
    },

    getRemaining() {
        return this.remaining;
    },

    setTotal(updateTotalInput) {
        this.total = this.getBookingTime() + this.getOffer();

        if (updateTotalInput) {
            this.updateTotalInput(this.total);
        }
    },

    getTotal() {
        return this.total;
    },

    updateRemainingInput(value) {
        const remainingInputs = $('.remaining');

        for (let input of remainingInputs) {
            $(input).val(this.round(value))
        }
    },

    updateTotalInput(value) {
        const totalInputs = $('.total');

        for (let input of totalInputs) {
            $(input).val(this.round(value))
        }
    },

    round(num) {
        let m = Number((Math.abs(num) * 100).toPrecision(15));
        return Math.round(m) / 100 * Math.sign(num);
    },
});

Alpine.store('profile', {
    preview() {
        avatar.style.display = "none";

        const url = URL.createObjectURL(photo.files[0]);

        preview.style.backgroundImage = `url(${url})`;
    }
});

Alpine.store('client', {
    set(clientId) {
        axios.get(`/clients/set`, {
            params: {
                client_id: clientId
            }
        }).then(response => {

        }).catch(errors => {

        });
    }
})
