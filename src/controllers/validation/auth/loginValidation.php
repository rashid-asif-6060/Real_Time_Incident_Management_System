<?php

function validateLoginInput($email, $password)
{
    $email = trim($email);
    $password = trim($password);

    if (empty($email) || empty($password)) {
        return "Email and Password are required!";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format!";
    }

    if (strlen($password) < 6) {
        return "Password must be at least 6 characters!";
    }

    return true;
}
