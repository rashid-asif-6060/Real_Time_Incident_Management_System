<?php
require_once "../includes/auth_check.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporter Dashboard</title>
    <link rel="stylesheet" href="../assets/css/reporter_dashboard.css">
</head>
<body>

<div class="dashboard">

    <header>
        <h2>Help Desk – Reporter</h2>
        <button id="myIssuesBtn">My Issues</button>
    </header>

    <!-- Report Issue -->
    <section class="report-box">
        <h3>Report an Issue</h3>

        <form id="issueForm">
            <select id="category" required>
                <option value="">Select Category</option>
                <option>Electrical</option>
                <option>Device</option>
                <option>Network</option>
                <option>Plumbing</option>
                <option>Others</option>
            </select>

            <input type="text" id="room" placeholder="Room Number" required>

            <textarea id="description" placeholder="Describe the problem" required></textarea>

            <select id="reporterType" required>
                <option value="">I am a</option>
                <option value="Student">Student</option>
                <option value="Faculty">Faculty</option>
            </select>

            <button type="submit">Submit Issue</button>
        </form>
    </section>

    <!-- Issues -->
    <section class="issues-box">
        <h3 id="issuesTitle">All Reported Issues</h3>
        <div id="issuesContainer"></div>
    </section>

</div>

<script src="../assets/js/reporter_dashboard.js"></script>
</body>
</html>

