
// Register Steps Display

document.getElementById('hideButton1').addEventListener('click', function () {
    var input = document.getElementById('email').value;
    if (input.trim() === '') {
        alert('Email field cannot be empty!');
        return; // Exit the function if input is empty
    } else if (!isValidEmail(input)) {
        alert('Please enter a valid email address!');
        return; // Exit the function if email is not valid
    } else {
        // Get the components you want to hide
        var componentsToHide = document.querySelectorAll('.emailcard');
        // Loop through the components and hide them
        componentsToHide.forEach(function (component) {
            component.style.display = 'none';
        });

        // Get the components you want to show
        var componentsToShow = document.querySelectorAll('.namecard');
        // Loop through the components and show them
        componentsToShow.forEach(function (component) {
            component.style.display = 'block';
        });
    }
});

// Function to validate email format
function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}


document.getElementById('hideButton2').addEventListener('click', function () {
    var firstName = document.getElementById('firstname').value;
    var lastName = document.getElementById('lastname').value;

    if (firstName.trim() === '' || lastName.trim() === '') {
        alert('First Name or Last Name field cannot be empty!');
        return; // Exit the function if input is empty
    } else {
        // Get the components you want to hide
        var componentsToHide = document.querySelectorAll('.namecard');
        // Loop through the components and hide them
        componentsToHide.forEach(function (component) {
            component.style.display = 'none';
        });

        // Get the components you want to show
        var componentsToShow = document.querySelectorAll('.passwordcard');
        // Loop through the components and show them
        componentsToShow.forEach(function (component) {
            component.style.display = 'block';
        });
    }
});

// Register Steps Display (Back Button)

document.getElementById('back1').addEventListener('click', function () {
    // Get the components you want to hide
    var components = document.querySelectorAll('.emailcard');
    // Loop through the components and hide them
    components.forEach(function (component) {
        component.style.display = 'block';
    });
});
document.getElementById('back1').addEventListener('click', function () {
    // Get the components you want to hide
    var components = document.querySelectorAll('.namecard');
    // Loop through the components and hide them
    components.forEach(function (component) {
        component.style.display = 'none';
    });
});



document.getElementById('back2').addEventListener('click', function () {
    // Get the components you want to hide
    var components = document.querySelectorAll('.namecard');
    // Loop through the components and hide them
    components.forEach(function (component) {
        component.style.display = 'block';
    });
});

document.getElementById('back2').addEventListener('click', function () {
    // Get the components you want to hide
    var components = document.querySelectorAll('.passwordcard');
    // Loop through the components and hide them
    components.forEach(function (component) {
        component.style.display = 'none';
    });
});

//message js
document.getElementById('contactForm').addEventListener('submit', function (event) {
    var message = document.getElementById('message').value;

    if (!message) {
        alert('Please fill out the message field.');
        event.preventDefault();
    }
});
