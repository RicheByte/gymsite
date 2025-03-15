<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include_once "component/dashboard_header.php"; // Include dashboard header
?>

<!-- Custom CSS for colorful and attractive design -->
<style>
    .chat-container {
        max-width: 800px;
        margin: 0 auto;
        border: 1px solid #ddd;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
    }

    .chat-box {
        height: 400px;
        padding: 20px;
        overflow-y: auto;
        background-color: #fff;
    }

    .chat-message {
        padding: 10px 15px;
        margin-bottom: 10px;
        border-radius: 10px;
        max-width: 70%;
        word-wrap: break-word;
    }

    .user-message {
        background-color: #007bff;
        color: white;
        margin-left: auto;
    }

    .bot-message {
        background-color: #e9ecef;
        color: #333;
        margin-right: auto;
    }

    .input-container {
        display: flex;
        padding: 15px;
        background-color: #f8f9fa;
        border-top: 1px solid #ddd;
    }

    .input-container input {
        flex: 1;
        margin-right: 10px;
        border-radius: 20px;
        border: 1px solid #ddd;
        padding: 10px 15px;
    }

    .input-container button {
        border-radius: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        border: none;
        color: white;
        transition: background-color 0.3s ease;
    }

    .input-container button:hover {
        background-color: #0056b3;
    }
</style>

<main class="container mt-5">
    <h1 class="text-center mb-4" style="color: #007bff; font-weight: bold;">AI Chat</h1>
    <div class="chat-container">
        <!-- Chat Box -->
        <div class="chat-box" id="chatBox">
            <!-- Default Bot Message -->
            <div class="chat-message bot-message">
                Hello! How can I assist you with your fitness journey today?
            </div>
        </div>
        <!-- Input Container -->
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

    // Function to append a message to the chat box
    function appendMessage(content, type) {
        const messageElement = `<div class="chat-message ${type}-message">${content}</div>`;
        chatBox.innerHTML += messageElement;
        chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll to the latest message
    }

    // Function to send a message to the AI and get a response
    async function sendMessage() {
        const message = userInput.value.trim();
        if (!message) return; // Do nothing if the input is empty

        appendMessage(message, "user"); // Display the user's message
        userInput.value = ""; // Clear the input field

        try {
            // Send the message to the server
            const response = await fetch("include/chat.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    message
                }),
            });

            const data = await response.json();
            appendMessage(data.reply, "bot"); // Display the bot's response
        } catch (error) {
            appendMessage("Error: Unable to connect to AI service.", "bot"); // Display an error message
        }
    }

    // Event listeners for the send button and Enter key
    sendBtn.addEventListener("click", sendMessage);
    userInput.addEventListener("keypress", function(event) {
        if (event.key === "Enter") sendMessage();
    });
</script>

<?php
include_once "component/dashboard_footer.php"; // Include dashboard footer
?>