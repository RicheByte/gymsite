<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include_once "component/dashboard_header.php";   //include dashboard header
?>


<main class="container mt-5">
    <h1 class="text-center mb-4">Leaderboard</h1>

    <!-- Search Bar -->
    <div class="input-group mb-4">
        <input type="text" id="searchInput" class="form-control" placeholder="Search for a name..." onkeyup="filterLeaderboard()">
    </div>

    <!-- Leaderboard Table -->
    <div class="table-responsive">
        <table class="table table-striped table-dark text-center">
            <thead>
                <tr>
                    <th style="color: #FFFFFF;">Rank</th>
                    <th style="color: #FFFFFF;">Name</th>
                    <th style="color: #FFFFFF;">Points</th>
                    <th style="color: #FFFFFF;">Progress</th>
                </tr>
            </thead>
            <tbody id="leaderboardTable">
                <tr style="color: #FFFFFF;">
                    <td>1</td>
                    <td>John Doe</td>
                    <td>150</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="150" aria-valuemin="0" aria-valuemax="150">150</div>
                        </div>
                    </td>
                </tr>
                <tr style="color: #FFFFFF;">
                    <td>2</td>
                    <td>Jane Smith</td>
                    <td>120</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%;" aria-valuenow="120" aria-valuemin="0" aria-valuemax="150">120</div>
                        </div>
                    </td>
                </tr>
                <tr class="table-warning" style="color: #333333;">
                    <td>3</td>
                    <td>You</td>
                    <td>100</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 67%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="150">100</div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>



<script>
    // Filter leaderboard dynamically
    function filterLeaderboard() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const tableRows = document.querySelectorAll("#leaderboardTable tr");

        tableRows.forEach(row => {
            const name = row.cells[1].textContent.toLowerCase();
            row.style.display = name.includes(searchInput) ? "" : "none";
        });
    }
</script>

<?php
   include_once "component/dashboard_footer.php";  //include dashboard footer
?>
