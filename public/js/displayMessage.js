// Function to display a message in the chat
function displayMessage(message, type) {
    var messageHTML = '<div class="message ', type; +'">' + message + '</div>';
    chatMessages.innerHTML += messageHTML;
    chatMessages.scrollTop = chatMessages.scrollHeight;
}
