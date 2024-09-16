// Modal for course enroll
var modalEnroll = document.getElementById("myModal-enroll");
var btnEnroll = document.getElementById("myBtn");
var spanEnrollClose = document.getElementsByClassName("close")[0];

btnEnroll.onclick = function () {
    modalEnroll.style.display = "block";
}

spanEnrollClose.onclick = function () {
    modalEnroll.style.display = "none";
}



// Drop Course Modal
// Drop Course Modal
var modalDrop = document.getElementById('myModal-drop');
var btnDrop = document.getElementById("dropBtn");
var spanDropClose = document.getElementsByClassName("cancel-drop")[0];
var btnCancelDrop = document.getElementById("cancelDrop");
var btnConfirmDrop = document.getElementById("confirmDrop");

// Open drop course modal
btnDrop.onclick = function () {
    modalDrop.style.display = "block";
}

// Close drop course modal
spanDropClose.onclick = function () {
    modalDrop.style.display = "none";
}

// Close drop course modal if clicked outside
window.onclick = function (event) {
    if (event.target == modalDrop) {
        modalDrop.style.display = "none";
    }
}

// Cancel drop action
btnCancelDrop.onclick = function () {
    modalDrop.style.display = "none";
}

// Confirm drop action
btnConfirmDrop.onclick = function () {
    var courseId = btnDrop.getAttribute("data-course-id"); // Get course ID from data attribute

    // Perform AJAX request to notify backend and update frontend
    fetch('/drop-course', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ courseId: courseId })
    })
        .then(response => response.json())
        .then(data => {
            // Hide modal
            modalDrop.style.display = "none";

            // Refresh the page to reflect changes
            location.reload();
        })
        .catch(error => console.error('Error dropping course:', error));
}

// Student Certificate of Completion