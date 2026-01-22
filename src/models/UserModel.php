<?php

    require_once __DIR__ . "/Database.php";


    $conn = getConnection();

    function registerUser($conn, $name, $email, $password, $role, $reporterType, $responderSkill)
    {
        $name  = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $role  = mysqli_real_escape_string($conn, strtolower($role));

        $reporterType = strtolower(trim($reporterType));
        $responderSkill = strtolower(trim($responderSkill));

        // Convert empty strings to NULL (IMPORTANT for ENUM columns)
        $reporterTypeSql = empty($reporterType) ? "NULL" : "'" . mysqli_real_escape_string($conn, $reporterType) . "'";
        $responderSkillSql = empty($responderSkill) ? "NULL" : "'" . mysqli_real_escape_string($conn, $responderSkill) . "'";

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $hashedPassword = mysqli_real_escape_string($conn, $hashedPassword);

        $query = "INSERT INTO users (name, email, password, role, reporter_type, responder_skill)
                VALUES ('$name', '$email', '$hashedPassword', '$role', $reporterTypeSql, $responderSkillSql)";

        return mysqli_query($conn, $query) ? true : false;
    }


    function loginUser($conn, $email, $password)
    {
        $sql = "SELECT id, name, email, password, role, reporter_type, responder_skill
                FROM users
                WHERE email = ? LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) return false;

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);

        if (!$user) return false;

        // Verify hashed password
        if (!password_verify($password, $user['password'])) {
            return false;
        }

        return $user;
    }
?>
