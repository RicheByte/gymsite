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
    .live-stream-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .live-stream-container h2 {
        color: #007bff;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }
    #userVideo {
        width: 100%;
        height: auto;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<main class="container mt-5">
    <div class="live-stream-container">
        <h2>Live Stream</h2>
        <!-- Video Element -->
        <video id="userVideo" autoplay playsinline></video>
    </div>
</main>

<script>
    async function watchLive() {
        try {
            // Fetch the offer from the server
            const response = await fetch("server.php");
            const data = await response.json();

            if (data.type === "offer") {
                // Create a new RTCPeerConnection
                const peer = new RTCPeerConnection();

                // Set the remote description with the offer
                await peer.setRemoteDescription(new RTCSessionDescription(data.offer));

                // Create an answer
                const answer = await peer.createAnswer();
                await peer.setLocalDescription(answer);

                // Send the answer back to the server
                await fetch("server.php", {
                    method: "POST",
                    body: JSON.stringify({ type: "answer", answer }),
                    headers: { "Content-Type": "application/json" }
                });

                // Handle incoming video stream
                peer.ontrack = (event) => {
                    document.getElementById("userVideo").srcObject = event.streams[0];
                };
            }
        } catch (error) {
            console.error("Error during live streaming setup:", error);
        }
    }

    // Start the live stream
    watchLive();
</script>

<?php
include_once "component/dashboard_footer.php"; // Include dashboard footer
?>

