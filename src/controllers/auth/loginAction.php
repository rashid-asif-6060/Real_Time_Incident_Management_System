<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../../models/Database.php";
require_once __DIR__ . "/../../models/UserModel.php";
require_once __DIR__ . "/../validation/auth/loginValidation.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ✅ start session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // ✅ make sure $conn exists (your old file didn't create it)
    $conn = getConnection();

    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $validation = validateLoginInput($email, $password);

    if ($validation !== true) {
        echo "
            <script>
                alert('$validation');
                window.location.href = '../../views/auth/login.php';
            </script>
        ";
        exit;
    }

    $user = loginUser($conn, $email, $password);

    if ($user) {
        // ✅ store session (ReporterController checks this)
        $_SESSION['user'] = [
            'id' => (int)$user['id'],
            'name' => $user['name'],
            'role' => $user['role'],
            'email' => $user['email'],
            'reporter_type' => $user['reporter_type'],
            'responder_skill' => $user['responder_skill']
        ];

        // ✅ OPTIONAL but good: also set cookies (ReporterController supports cookies too)
        setcookie("user_id", (string)$user['id'], time() + 86400, "/");
        setcookie("user_role", $user['role'], time() + 86400, "/");
        setcookie("user_name", $user['name'], time() + 86400, "/");


        // Redirect based on role (adjust paths to match your project)
        if ($user['role'] === 'admin') {
            header("Location: ../../views/dashboard/admin.php");
        } elseif ($user['role'] === 'responder') {
            header("Location: ../../views/dashboard/responder.php");
        } elseif ($user['role'] === 'reporter') {
            header("Location: ../../views/dashboard/reporter.php");
        }
        exit;

    } else {
        echo "
            <script>
                alert('Invalid email or password!');
                window.location.href = '../../views/auth/login.php';
            </script>
        ";
        exit;
    }
}

?>