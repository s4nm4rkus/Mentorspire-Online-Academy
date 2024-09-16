document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('modal');
  const openModalBtn = document.getElementById('openModalBtn');
  const closeModal = document.getElementsByClassName('close')[0];
  const content = document.querySelector('.content');

  openModalBtn.onclick = function () {
    modal.style.display = 'flex';
    content.style.width = '60%'; // Adjust content width when modal is open
    openModalBtn.style.display = 'none'; // Hide the button when modal is open
  }

  closeModal.onclick = function () {
    modal.style.display = 'none';
    content.style.width = '100%'; // Reset content width when modal is closed
    openModalBtn.style.display = 'block'; // Show the button when modal is closed
  }

  window.onclick = function (event) {
    if (event.target === modal) {
      modal.style.display = 'none';
      content.style.width = '100%';
      openModalBtn.style.display = 'block'; // Show the button when modal is closed
    }
  }
}
);

//send messages
function sendEmail() {
  var message = document.getElementById("message").value.trim();
  var emailAddress = "mentorspireitservices@gmail.com";
  var subject = "Message from Mentorspire IOT user";
  var body = encodeURIComponent(message);

  // Construct the Gmail compose URL
  var gmailURL = "https://mail.google.com/mail/?view=cm&to=" + encodeURIComponent(emailAddress) + "&su=" + encodeURIComponent(subject) + "&body=" + body;

  // Open Gmail in a new window
  window.open(gmailURL);

  // Clear the message textbox
  document.getElementById("message").value = "";
}

//link for gmail and facebook
function openLink(url) {
  window.open(url, '_blank');
}


//send