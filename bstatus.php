<?php
include("mysql.php");

// Fetch the booking ID from the URL
$bookingid = isset($_GET['bookingid']) ? $_GET['bookingid'] : '';

// Fetch booking details from the database
$query = "SELECT * FROM booking WHERE bookingid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $bookingid);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Status</title>
    <link rel="stylesheet" href="css/navCSS.css">
    <link rel="stylesheet" href="css/foterCSS.css">
    <link rel="stylesheet" href="css/nav1.css">
    <link rel="stylesheet" href="css/bstatuscss.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="main">
        <div class="main1">
            <img src="<?php echo$_GET['image'];?>" >
            <?php if ($booking): ?>
                <div class="row">
                    <div class="heading">Booking ID:</div>
                    <div><?php echo$_GET['bookingid']; ?></div>
                </div>
                <div class="row">
                    <div class="heading">Name:</div>
                    <div><?php echo htmlspecialchars($booking['name'], ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="row">
                    <div class="heading">Pickup Point:</div>
                    <div><?php echo htmlspecialchars($booking['pick'], ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="row">
                    <div class="heading">Destination:</div>
                    <div><?php echo htmlspecialchars($booking['dest'], ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="row">
                    <div class="heading">Contact No:</div>
                    <div><?php echo htmlspecialchars($booking['cn'], ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="row">
                    <div class="heading">Journey Beginning Date:</div>
                    <div><?php echo htmlspecialchars($booking['bdate'], ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="row">
                    <div class="heading">Expected Return Date:</div>
                    <div><?php echo htmlspecialchars($booking['edate'], ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="row">
                    <div class="heading">No of Passengers:</div>
                    <div><?php echo htmlspecialchars($booking['nop'], ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="row">
                    <div class="heading">Status:</div>
                    <div><?php echo htmlspecialchars($booking['status'], ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="note">**Our Team Will Contact You 24 Hour Before The Booking Date And Confirm The Timming And Location From You Then Also Provided The Driver Contact No.**</div>
                <div class="tnc">
                    <p>**<a href="tnc.php" target="_blank">Terms and Conditions</a> Applied** </p>
                </div>
            <?php else: ?>
                <div class="row">
                    <div>No booking details found for the provided booking ID.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php include 'foter.php'; ?>
</body>
</html>
