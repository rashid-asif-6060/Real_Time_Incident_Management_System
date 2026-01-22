<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Help Desk</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

<div class="auth-box">
    <h2>Login</h2>

    <form action="../../controllers/auth/loginAction.php" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <p>No account? <a href="register.php">Register</a></p>
</div>

</body>
</html>

