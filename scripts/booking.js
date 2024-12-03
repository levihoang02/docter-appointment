let offices = [];
let doctors = [];
let slots = [];

function ajaxSearch(model, query, callback) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `../services/search.php?model=${model}&query=${query}`, true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const results = JSON.parse(xhr.responseText); // Parse JSON response
            callback(results); // Use a callback to return results
        } else {
            callback([]); // Return an empty array on error
        }
    };

    xhr.onerror = function() {
        console.error('Error fetching search results');
        callback([]); // Return an empty array on error
    };

    xhr.send();
}

function initializeApp() {
    console.log("Initializing app...");
    const officeOption = document.getElementById('doctor_office');
    const docterOption = document.getElementById('doctor');
    const slotOption = document.getElementById('time_slot');

    ajaxSearch('slots', 'all', function(slots) {
        slotOption.innerHTML = slots.map((result) => {
            return `<option value="${result.id}" class="list-slot-item">${result.name}</option>`;
        }).join('');
    });

    // Fetch offices
    ajaxSearch('offices', 'all', function(offices) {
        officeOption.innerHTML = offices.map((result) => {
            return `<option value="${result.id}" class="list-office-item">${result.name}</option>`;
        }).join('');
        if (offices.length > 0) {
            const firstOptionValue = officeOption.options[0].value; // Get the value of the first option
            ajaxSearch('docters', firstOptionValue, function(docters) {
                docterOption.innerHTML = docters.map((result) => {
                    return `<option value="${result.id}" class="list-docter-item">${result.name}</option>`;
                }).join('');
                if(docters.length > 0) {
                    const firstDocterValue = docterOption.options[0].value;
                    ajaxSearch('slots', firstDocterValue, function(data) {
                        let bookedSlots = data.map(booking => String(booking.id));
                        Array.from(slotOption.options).forEach(option => {
                            // console.log(bookedSlots,  " value", typeof(option.value), " re: ", bookedSlots.includes(option.value));
                            if (bookedSlots.includes(option.value)) {
                                console.log(option.value);
                                option.disabled = true;
                            }
                        });
                    });
                }
            });
        }
    });

    officeOption.addEventListener('change', function(event) {
        const selectedValue = event.target.value;
        ajaxSearch('docters', selectedValue, function(docters) {
            docterOption.innerHTML = docters.map((result) => {
                return `<option value="${result.id}" class="list-docter-item">${result.name}</option>`;
            }).join('');
            // slotOption.innerHTML = '';
        });
    });

    docterOption.addEventListener('change', function(event) {
        const selectedValue = event.target.value;
        ajaxSearch('slots', selectedValue, function(data) {
            let bookedSlots = data.map(booking => String(booking.id));
            Array.from(slotOption.options).forEach(option => {
                // console.log(bookedSlots,  " value", typeof(option.value), " re: ", bookedSlots.includes(option.value));
                if (bookedSlots.includes(option.value)) {
                    option.disabled = true;
                }
                else {
                    option.disabled = false;
                }
            });
        });
    });
}

document.addEventListener("DOMContentLoaded", initializeApp());