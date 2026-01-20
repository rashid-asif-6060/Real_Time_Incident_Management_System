
<?php
$requiredRole = 'Admin';
require_once "../includes/auth_check.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

<header class="navbar">
    <h2>Incident Management System</h2>
    <nav>
        <a href="../profile/profile.php">Profile</a>
        <a href="../auth/logout.php">Logout</a>
    </nav>
</header>

<main class="dashboard">
    <h1>Admin Dashboard</h1>

    <section class="cards">
        <div class="card">Intelligent Incident Routing</div>
        <div class="card">Fake Report Detection</div>
        <div class="card">SLA Monitoring & Escalation</div>
        <div class="card">System Analytics & Forecast</div>
    </section>
</main>

</body>
</html>

