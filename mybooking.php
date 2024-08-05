<?php
include 'mysql.php'; // Include your database connection file
session_start(); // Start the session
error_reporting(0);
// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$user_id = $_SESSION['name']; // Get the user ID from session

// Handle the cancellation request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel_booking_id'])) {
    $booking_id = $_POST['cancel_booking_id'];

    // Update the booking status to "Cancelled"
    $cancel_query = "UPDATE booking SET status = 'Cancelled' WHERE bookingid = ? AND name = ?";
    $cancel_stmt = $conn->prepare($cancel_query);
    $cancel_stmt->bind_param("is", $booking_id, $user_id);
    $cancel_stmt->execute();
    $cancel_stmt->close();

    echo '<script>alert("Booking cancelled successfully!"); window.location.href = "mybooking.php";</script>';
}

// Determine the status filter
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'All';

// Fetch bookings for the logged-in user
$query = "
    SELECT b.*,
           v.image,
           TIMESTAMPDIFF(HOUR, NOW(), b.bdate) AS hours_to_start
    FROM booking b
    JOIN (
        SELECT rn, image FROM bikes
        UNION
        SELECT rn, image FROM scooty
        UNION
        SELECT rn, image FROM car
    ) v ON b.rn = v.rn
    WHERE b.name = ? ";

// Add status filter to the query if not 'All'
if ($status_filter != 'All') {
    $query .= "AND b.status = ? ";
}

$query .= "ORDER BY b.bookingid DESC";

$stmt = $conn->prepare($query);
if ($status_filter != 'All') {
    $stmt->bind_param("ss", $user_id, $status_filter);
} else {
    $stmt->bind_param("s", $user_id);
}
$stmt->execute();
$result = $stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="css/navCSS.css">
    <link rel="stylesheet" href="css/mybookingcss.css"> <!-- Add your CSS file here -->
    <link rel="stylesheet" href="css/nav1.css">
    <link rel="stylesheet" href="css/foterCSS.css">
</head>
<body>
<?php include 'navbar.php';?>
    <div class="container">
        <h2>My Bookings</h2>

        <div class="filter">
            <form method="GET" action="">
                <label for="status">Filter by Status: </label>
                <select name="status" id="status" onchange="this.form.submit()">
                    <option value="All" <?php if ($status_filter == 'All') echo 'selected'; ?>>All</option>
                    <option value="Requested" <?php if ($status_filter == 'Requested') echo 'selected'; ?>>Requested</option>
                    <option value="Confirmed" <?php if ($status_filter == 'Confirmed') echo 'selected'; ?>>Confirmed</option>
                    <option value="Ongoing" <?php if ($status_filter == 'Ongoing') echo 'selected'; ?>>Ongoing</option>
                    <option value="Finished" <?php if ($status_filter == 'Finished') echo 'selected'; ?>>Finished</option>
                    <option value="Cancelled" <?php if ($status_filter == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                </select>
            </form>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Image</th>
                        <th>Pick-Up</th>
                        <th>Destination</th>
                        <th>Booking Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                        <th>Cancel</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php
                            // Determine the status class
                            $statusClass = '';
                            switch ($row['status']) {
                                case 'Requested':
                                    $statusClass = 'status-requested';
                                    break;
                                case 'Confirmed':
                                    $statusClass = 'status-confirmed';
                                    break;
                                case 'Ongoing':
                                    $statusClass = 'status-ongoing';
                                    break;
                                case 'Finished':
                                    $statusClass = 'status-finished';
                                    break;
                                case 'Cancelled':
                                    $statusClass = 'status-cancelled';
                                    break;
                            }

                            // Determine if the cancellation button should be enabled
                            $cancelEnabled = $row['hours_to_start'] >= 24;
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['bookingid'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="bstatus.php?bookingid=<?php echo$row['bookingid'];?> & image=<?php echo$row['image'];?>">
                                    <img src="<?php echo htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Vehicle" class="vehicle-image">
                                </a>
                            </td>
                            <td><?php echo htmlspecialchars($row['pick'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['dest'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['bdate'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['edate'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><span class="status <?php echo $statusClass; ?>"><?php echo htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8'); ?></span></td>
                            <td>
                                <?php if ($row['status'] != 'Cancelled' && $row['status'] != 'Finished'): ?>
                                    <form method="POST" action="">
                                        <input type="hidden" name="cancel_booking_id" value="<?php echo $row['bookingid']; ?>">
                                        <button type="submit" class="cancel-btn" <?php echo $cancelEnabled ? '' : 'disabled'; ?>>Cancel</button>
                                    </form>
                                <?php else: ?>
                                    <span class="status-cancelled"></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="message">No bookings found.</p>
        <?php endif; ?>
    </div>
<?php include 'foter.php';?>
</body>
</html>
