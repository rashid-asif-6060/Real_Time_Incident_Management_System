<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile | Help Desk</title>

    <link rel="stylesheet" href="../assets/css/profile.css">
</head>
<body>

<div class="profile-box">

    <h2>Profile Management</h2>

    <form>
        <div class="profile-group">
            <label>Full Name</label>
            <input type="text" name="fullname" value="Rashid Asif" required>
        </div>

        <div class="profile-group">
            <label>Email</label>
            <input type="email" name="email" value="rashid@email.com" readonly>
        </div>

        <div class="profile-group">
            <label>Role</label>
            <input type="text" value="Reporter" readonly>
        </div>

        <div class="profile-group">
            <label>Phone</label>
            <input type="text" name="phone" placeholder="Enter phone number">
        </div>

        <div class="profile-actions">
            <button type="submit" class="save-btn">Save Changes</button>
            <button type="reset" class="cancel-btn">Cancel</button>
        </div>
    </form>

</div>

<script src="../assets/js/profile.js"></script>
</body>
</html>

