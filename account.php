

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
    <link rel="stylesheet" href="css/accountCSS.css">
    <link rel="stylesheet" href="css/navCSS.css">
    <link rel="stylesheet" href="css/passchangecss.css"> <!-- Add your CSS file here -->
    <link rel="stylesheet" href="css/nav1.css">
    <link rel="stylesheet" href="css/foterCSS.css">
</head>
<body>
    <?php include 'navbar.php';?>
    <?php
include('mysql.php'); // Include your database connection

// Check if the user is logged in
if(!isset($_SESSION['name'])) {
    header('Location: login_page.php'); // Redirect to login page if not logged in
    exit();
}

// Fetch user details
$name = $_SESSION['name'];
$query = "SELECT * FROM user_detail WHERE name = '$name'";
$data = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($data);
?>
    <div class="container1">
        <ul>
            <li><a href="#personal-details">Personal Detail</a></li>
            <li><a href="#address-details">Address Detail</a></li>
            <li><a href="mybooking.php">Booking Detail</a></li>
            <li><a href="change_password.php">Change Password</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div id="personal-details" class="details-section">
        <h2>Personal Information</h2>
        <table>
            <tr>
                <th>Name:</th>
                <td><?php echo htmlspecialchars($result['name']); ?></td>
            </tr>
            <tr>
                <th>Mobile:</th>
                <td><?php echo htmlspecialchars($result['mob']); ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo htmlspecialchars($result['email']); ?></td>
            </tr>
            <tr>
                <th>Date Of Birth:</th>
                <td><?php echo htmlspecialchars($result['dob']); ?></td>
            </tr>
            <tr>
                <th>Aadhar Card No:</th>
                <td><?php echo htmlspecialchars($result['aid']); ?></td>
            </tr>
        </table>
    </div>

    <div id="address-details" class="details-section">
        <h2>Address</h2>
        <table>
            <tr>
                <th>State:</th>
                <td><?php echo htmlspecialchars($result['state']); ?></td>
            </tr>
            <tr>
                <th>District:</th>
                <td><?php echo htmlspecialchars($result['district']); ?></td>
            </tr>
            <tr>
                <th>Village:</th>
                <td><?php echo htmlspecialchars($result['village']); ?></td>
            </tr>
            <tr>
                <th>Street:</th>
                <td><?php echo htmlspecialchars($result['street']); ?></td>
            </tr>
            <tr>
                <th>Pincode:</th>
                <td><?php echo htmlspecialchars($result['pincode']); ?></td>
            </tr>
        </table>
    </div>
    <?php include 'foter.php';?>
</body>
</html>
