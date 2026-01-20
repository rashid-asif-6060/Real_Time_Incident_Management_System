<?php
$requiredRole = 'Responder';
require_once "../includes/auth_check.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Responder Dashboard</title>
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
    <h1>Responder Dashboard</h1>

    <section class="cards">
        <div class="card">Priority Task Queue</div>
        <div class="card">Work Time Tracking</div>
        <div class="card">Root Cause Classification</div>
        <div class="card">Incident Resolution History</div>
    </section>
</main>

</body>
</html>

