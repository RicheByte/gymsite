// ai-chat.js

document.getElementById("sendBtn").addEventListener("click", function() {
    const userInput = document.getElementById("userInput").value;
    if (userInput.trim() !== "") {
        addMessage(userInput, "user");
        document.getElementById("userInput").value = "";

        // Simulate bot response
        setTimeout(() => {
            addMessage("I am processing your request... Feel free to ask anything about your fitness.", "bot");
        }, 1000);
    }
});

function addMessage(message, sender) {
    const messageContainer = document.createElement("div");
    messageContainer.classList.add("chat-message", sender === "bot" ? "bot-message" : "user-message");
    messageContainer.textContent = message;
    
    document.querySelector(".chat-box").appendChild(messageContainer);
    document.querySelector(".chat-box").scrollTop = document.querySelector(".chat-box").scrollHeight;
}
