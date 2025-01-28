<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include_once "component/dashboard_header.php";   // Include dashboard header
?>

<main class="container mt-5">
    <h1>AI Chat</h1>
    <div class="chat-container">
        <div class="chat-box" id="chatBox">
            <div class="chat-message bot-message">
                Hello! How can I assist you with your fitness journey today?
            </div>
        </div>
        <div class="input-container">
            <input type="text" id="userInput" class="form-control" placeholder="Ask me anything...">
            <button class="btn btn-primary" id="sendBtn">Send</button>
        </div>
    </div>
</main>

<script>
    const sendBtn = document.getElementById("sendBtn");
    const userInput = document.getElementById("userInput");
    const chatBox = document.getElementById("chatBox");

    sendBtn.addEventListener("click", async () => {
        const message = userInput.value.trim();
        if (!message) return;

        // Display user message
        const userMessage = `<div class="chat-message user-message">${message}</div>`;
        chatBox.innerHTML += userMessage;
        userInput.value = "";

        // Call backend to get bot response
        const response = await fetch("chat.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ message }),
        });

        const data = await response.json();
        const botMessage = `<div class="chat-message bot-message">${data.reply}</div>`;
        chatBox.innerHTML += botMessage;

        // Scroll to bottom
        chatBox.scrollTop = chatBox.scrollHeight;
    });
</script>

<?php
include_once "component/dashboard_footer.php";  // Include dashboard footer
?>
