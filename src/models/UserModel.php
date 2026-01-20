<?php

    include("Database.php");

    $conn = getConnection();

    function registerUser($conn, $name, $email, $password, $role) {

        // Sanitize input
        $name  = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $role  = mysqli_real_escape_string($conn, strtolower($role));

        // Hash password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Insert query
        $query = "INSERT INTO users (name, email, password, role)
                VALUES ('$name', '$email', '$password', '$role')";

        if (mysqli_query($conn, $query)) {
            return true;
        } else {
            return false;
        }
    }
?>
