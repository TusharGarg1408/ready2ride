<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password | Ready2ride</title>
    <link rel="stylesheet" href="css/navCSS.css">
    <link rel="stylesheet" href="css/passchangecss.css"> <!-- Add your CSS file here -->
    <link rel="stylesheet" href="css/nav1.css">
    <link rel="stylesheet" href="css/foterCSS.css">
</head>

<body>
    <?php include 'navbar.php';?>
    <?php
include 'mysql.php'; // Ensure your database connection file is included
// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$name = $_SESSION['name']; // Get the user's name from session

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch the current password hash from the database
    $query = "SELECT password FROM user_detail WHERE name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify the current password
        if ($current_password=$hashed_password) {
            // Check if new passwords match
            if ($new_password === $confirm_password) {
                // Update the password in the database
                $update_query = "UPDATE user_detail SET password = ? WHERE name = ?";
                $update_stmt = $conn->prepare($update_query);
                $update_stmt->bind_param("ss", $new_password, $name);

                if ($update_stmt->execute()) {
                    echo '<script>alert("Password updated successfully!"); window.location.href = "index.php";</script>';
                } else {
                    echo '<script>alert("Failed to update password. Please try again.");</script>';
                }

                $update_stmt->close();
            } else {
                echo '<script>alert("New passwords do not match.");</script>';
            }
        } else {
            echo '<script>alert("Current password is incorrect.");</script>';
        }
    } else {
        echo '<script>alert("User not found.");</script>';
    }

    $stmt->close();
}

$conn->close();
?>

    <div class="container">
        <h2>Change Password</h2>
        <form method="POST" action="">
            <label for="current_password">Current Password:</label>
            <input type="password" name="current_password" id="current_password" required>

            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password" required>

            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>

            <button type="submit">Change Password</button>
        </form>
    </div>
    <?php include 'foter.php';?>
</body>

</html>