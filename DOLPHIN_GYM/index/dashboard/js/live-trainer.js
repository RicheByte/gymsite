// live-trainer.js

document.getElementById("sendChatBtn").addEventListener("click", function() {
    const userInput = document.getElementById("chatInput").value;
    if (userInput.trim() !== "") {
        addMessage(userInput, "user");
        document.getElementById("chatInput").value = "";

        // Simulate trainer's response
        setTimeout(() => {
            addMessage("Thanks for your question! Please keep asking if you need any help during the session.", "bot");
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
