<?php
session_start();

// Redirect to the login page if the admin is not logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php?message=admin_dashboard_not_login');
    exit;
}

// Include admin header and database connection
include_once 'components/admin_header.php';
require_once 'include/db.php';
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
    #adminVideo {
        width: 100%;
        height: auto;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .btn-primary:focus {
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
</style>

<main class="container mt-5">
    <div class="live-stream-container">
        <h2>Admin - Live Streaming</h2>
        <!-- Video Element -->
        <video id="adminVideo" autoplay playsinline></video>
        <!-- Start Live Button -->
        <button class="btn btn-primary w-100" onclick="startStreaming()">Start Live</button>
    </div>
</main>

<script>
    async function startStreaming() {
        try {
            // Request access to the user's camera and microphone
            const stream = await navigator.mediaDevices.getUserMedia({
                video: true,
                audio: true
            });

            // Display the live stream in the video element
            document.getElementById("adminVideo").srcObject = stream;

            // Get the video track from the stream
            const videoTrack = stream.getVideoTracks()[0];

            // Create a new RTCPeerConnection
            const peer = new RTCPeerConnection();

            // Add the video track to the peer connection
            peer.addTrack(videoTrack, stream);

            // Create an offer for the WebRTC connection
            const offer = await peer.createOffer();
            await peer.setLocalDescription(offer);

            // Send the offer to the server
            await fetch("server.php", {
                method: "POST",
                body: JSON.stringify({
                    type: "offer",
                    offer
                }),
                headers: {
                    "Content-Type": "application/json"
                }
            });

            console.log("Live streaming started successfully!");
        } catch (error) {
            console.error("Error starting live streaming:", error);
            alert("Failed to start live streaming. Please check your camera and microphone permissions.");
        }
    }
</script>

<?php
include_once 'components/admin_footer.php'; // Include admin footer
?>