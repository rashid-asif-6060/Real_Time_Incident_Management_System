

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration | Help Desk System</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

    <div class="auth-box">
        <h2>Create Account</h2>

        <form action="../../controllers/auth/registerAction.php" method="POST">

            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>

            <!-- Role -->
            <select name="role" id="role" required>
                <option value="">Select Role</option>
                <option value="reporter">Reporter</option>
                <option value="responder">Responder</option>
            </select>

            <!-- Reporter Type -->
            <div id="reporterBox" style="display:none;">
                <select name="reporterType" id="reporterType" disabled>
                    <option value="">Reporter Type</option>
                    <option value="student">Student</option>
                    <option value="faculty">Faculty</option>
                </select>
            </div>

            <!-- Responder Skill -->
            <div id="responderBox" style="display:none;">
                <select name="responderType" id="responderType" disabled>
                    <option value="">Responder Skill</option>
                    <option value="electrician">Electrician</option>
                    <option value="technician">Technician</option>
                    <option value="network_engineer">Network Engineer</option>
                    <option value="plumber">Plumber</option>
                </select>
            </div>

            <input type="password" name="password" placeholder="Password" required>

            <input type="password" name="confirm_password" placeholder="Confirm Password" required>

            <div class="form-actions"> 
                <button type="submit">Confirm</button> 
                <button type="button" onclick="location.href='login.php'">Cancel</button> 
            </div>
        </form>

    </div>

<script src="../assets/js/auth.js"></script>
</body>
</html>

