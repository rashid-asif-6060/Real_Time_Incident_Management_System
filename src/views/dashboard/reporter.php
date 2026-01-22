<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporter Dashboard</title>

    <link rel="stylesheet" href="../assets/css/reporter_dashboard.css">

    <!-- IMPORTANT: defer so DOM loads first -->
    <script src="../assets/js/reporter_dashboard.js" defer></script>
</head>
<body>

<div class="dashboard">

    <header class="dashboard-header">
        <h2>Help Desk – Reporter</h2>

        <!-- ✅ GROUPED ACTION BUTTONS -->
        <div class="header-actions">
            <button id="myIssuesBtn" type="button">My Issues</button>

            <form action="../../controllers/logout.php" method="POST">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </header>

    <!-- Report Issue -->
    <section class="report-box">
        <h3>Report an Issue</h3>

        <form action="../../controllers/ReporterController.php" id="issueForm" method="POST">
            <select id="category" name="category" required>
                <option value="">Select Category</option>
                <option value="Electrical">Electrical</option>
                <option value="Device">Device</option>
                <option value="Network">Network</option>
                <option value="Plumbing">Plumbing</option>
                <option value="Others">Others</option>
            </select>

            <input type="text" id="room" name="room" placeholder="Room Number" required>

            <textarea id="description" name="description" placeholder="Describe the problem" required></textarea>

            <select id="reporterType" name="reporterType" required>
                <option value="">I am a</option>
                <option value="student">Student</option>
                <option value="faculty">Faculty</option>
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

</body>
</html>
