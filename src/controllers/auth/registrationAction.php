<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../../models/userModel.php");
include("../validation/auth/registerValidation.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Fetch form data safely
    $name             = $_POST['name'] ?? '';
    $email            = $_POST['email'] ?? '';
    $role             = $_POST['role'] ?? '';
    $password         = $_POST['password'] ?? '';
    $confirmPassword  = $_POST['confirm_password'] ?? '';

    // Validate input
    $validation = validateRegisterInput(
        $name,
        $email,
        $role,
        $password,
        $confirmPassword
    );

    if ($validation === true) {

        if (registerUser($conn, $name, $email, $password, $role)) {

            echo "
                <script>
                    alert('Registration Successful!');
                    window.location.href = '../../views/auth/login.php';
                </script>
            ";
            exit;

        } else {
            echo "
                <script>
                    alert('Error: Could not register user.');
                    window.location.href = '../../views/auth/register.php';
                </script>
            ";
        }

    } else {
        echo "
            <script>
                alert('$validation');
                window.location.href = '../../views/auth/register.php';
            </script>
        ";
    }
}
?>
