<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include_once "component/dashboard_header.php";   //include dashboard header
?>

    <main class="container mt-5">
        <h1>Live Trainer</h1>
        <div class="live-stream-container">
            <div class="video-container">
                <!-- Placeholder for live stream video -->
                <video id="liveStream" class="w-100" controls autoplay>
                    <source src="path_to_live_stream_video.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <p class="text-center mt-3">Live Fitness Training Session</p>
            </div>

            <div class="chat-container mt-5">
                <h3>Chat with Trainer</h3>
                <div class="chat-box">
                    <!-- Example bot message -->
                    <div class="chat-message bot-message">
                        Welcome! Ask the trainer any questions during the live stream.
                    </div>
                </div>
                <div class="input-container">
                    <input type="text" id="chatInput" class="form-control" placeholder="Type your message...">
                    <button class="btn btn-primary" id="sendChatBtn">Send</button>
                </div>
            </div>
        </div>
    </main>



    <script src="../js/live-trainer.js"></script>


    
<?php
   include_once "component/dashboard_footer.php";  //include dashboard footer
?>

