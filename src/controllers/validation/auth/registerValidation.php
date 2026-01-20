<?php

function validateRegisterInput($name, $email, $role, $password, $confirmPassword)
{
    // Trim inputs
    $name = trim($name);
    $email = trim($email);
    $role = trim($role);

    // 1. Empty check
    if (empty($name) || empty($email) || empty($role) || empty($password) || empty($confirmPassword)) {
        return "All fields are required.";
    }

    // 2. Name validation (letters & spaces only)
    if (!preg_match("/^[a-zA-Z ]{3,50}$/", $name)) {
        return "Name must be 3–50 characters long and contain only letters and spaces.";
    }

    // 3. Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email address.";
    }

    // 4. Role validation
    $allowedRoles = ['reporter', 'responder'];
    if (!in_array(strtolower($role), $allowedRoles)) {
        return "Invalid role selected.";
    }

    // 5. Password length
    if (strlen($password) < 6) {
        return "Password must be at least 8 characters long.";
    }

    // // 6. Password strength
    // if (
    //     !preg_match("/[A-Z]/", $password) ||   // uppercase
    //     !preg_match("/[a-z]/", $password) ||   // lowercase
    //     !preg_match("/[0-9]/", $password)      // number
    // ) {
    //     return "Password must contain at least one uppercase letter, one lowercase letter, and one number.";
    // }

    // 7. Password match
    if ($password !== $confirmPassword) {
        return "Passwords do not match.";
    }

    // All checks passed
    return true;
}
