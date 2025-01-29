 // Function to calculate rent and create rent button dynamically
 function calculateRent(fromDateId, toDateId, startTimeId, endTimeId, rentalPrice) {
    var fromDate = new Date(document.getElementById(fromDateId).value);
    var toDate = new Date(document.getElementById(toDateId).value);
    var startTime = document.getElementById(startTimeId).value;
    var endTime = document.getElementById(endTimeId).value;

    var startTimeArray = startTime.split(':');
    var endTimeArray = endTime.split(':');

    var startDateTime = new Date(fromDate);
    startDateTime.setHours(startTimeArray[0]);
    startDateTime.setMinutes(startTimeArray[1]);

    var endDateTime = new Date(toDate);
    endDateTime.setHours(endTimeArray[0]);
    endDateTime.setMinutes(endTimeArray[1]);

    var timeDiff = Math.abs(endDateTime - startDateTime);
    var hours = Math.ceil(timeDiff / (1000 * 60 * 60)); // Calculating hours

    var rent = hours * rentalPrice; // Calculating rent

    // Check if a button already exists, if not, create one
    var rentButtonId = 'rentButton' + fromDateId.slice(-1);
    var rentButton = document.getElementById(rentButtonId);
    if (!rentButton) {
        // Create and display the rent button
        rentButton = document.createElement('button');
        rentButton.id = rentButtonId;
        rentButton.innerText = 'Rent Price: $' + rent.toFixed(2);
        rentButton.classList.add('rented-price-button');
        rentButton.addEventListener('click', function() {
            // Redirect to payment.html when the button is clicked
            var paymentUrl = 'payment.html?rent=' + rent.toFixed(2);
            window.location.href = paymentUrl;
        });
        document.getElementById(toDateId).parentNode.appendChild(rentButton);
    }
}

// Add event listeners for each form
document.getElementById('rentForm1').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
    calculateRent('fromDate1', 'toDate1', 'startTime1', 'endTime1', 150);
});

document.getElementById('rentForm2').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
    calculateRent('fromDate2', 'toDate2', 'startTime2', 'endTime2', 200);
});

document.getElementById('rentForm3').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
    calculateRent('fromDate3', 'toDate3', 'startTime3', 'endTime3', 250);
});

