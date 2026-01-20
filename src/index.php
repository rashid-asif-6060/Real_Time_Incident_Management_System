<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Incident Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            background: #f5f7fb;
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: #ffffff;
            width: 90%;
            max-width: 800px;
            padding: 60px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        h1 {
            font-size: 34px;
            margin-bottom: 15px;
            color: #1f2937;
        }

        p {
            font-size: 16px;
            color: #555;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .buttons a {
            display: inline-block;
            padding: 12px 32px;
            margin: 0 10px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .login {
            background: #2563eb;
            color: #fff;
        }

        .login:hover {
            background: #1e40af;
        }

        .register {
            background: #e5e7eb;
            color: #111;
        }

        .register:hover {
            background: #d1d5db;
        }

        @media (max-width: 600px) {
            .container {
                padding: 40px 25px;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Incident Management System</h1>
    <p>
        A simple and efficient platform to report, track, and manage incidents
        within the organization.
    </p>

    <div class="buttons">
        <a href="../views/auth/login.php" class="login">Login</a>
        <a href="../views/auth/register.php" class="register">Register</a>
    </div>
</div>

</body>
</html>
