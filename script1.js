// Function to calculate rent and submit form data
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

    // Create form data object
    var formData = new FormData();
    formData.append('bike_name', document.getElementById('bike_name').value);
    formData.append('fromDate', fromDate.toISOString().split('T')[0]); // Format date as YYYY-MM-DD
    formData.append('toDate', toDate.toISOString().split('T')[0]); // Format date as YYYY-MM-DD
    formData.append('startTime', startTime);
    formData.append('endTime', endTime);
    formData.append('rentalPrice', rentalPrice);

    // Send form data to PHP script using fetch API
    fetch('process_rental.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(data => {
        console.log(data); // Log response from server
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
}
