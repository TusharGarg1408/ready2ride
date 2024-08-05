<?php // Start the session
include("mysql.php");?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="css/navCSS.css">
    <link rel="stylesheet" href="css/nav1.css">
    <link rel="stylesheet" href="css/foterCSS.css">
    <link rel="stylesheet" href="css/bookingpageCSS.css">
    <script>
    function validateForm() {
        var name = document.getElementById("name").value.trim();
        var pick = document.getElementById("pick").value.trim();
        var dest = document.getElementById("dest").value.trim();
        var bdate = document.getElementById("bdate").value;
        var edate = document.getElementById("edate").value;
        var cn = document.getElementById("cn").value.trim();
        var nop = document.getElementById("nop").value;
        var termsChecked = document.getElementById("terms").checked;

        if (name == "" || pick == "" || dest == "" || bdate == "" || edate == "" || cn == "" || nop == "") {
            alert("All fields are required!");
            return false;
        }

        if (!termsChecked) {
            alert("You must agree to the Terms and Conditions.");
            return false;
        }

        return true;
    }
</script>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <?php
// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    echo '<script>alert("Please log in first!"); window.location.href = "login_page.php";</script>';
    exit();
}

// Fetch user details from the session
$userName = $_SESSION['name'];

// Query to fetch user details
$userQuery = "SELECT * FROM user_detail WHERE name = ?";
$stmtUser = $conn->prepare($userQuery);
$stmtUser->bind_param("s", $userName);
$stmtUser->execute();
$userResult = $stmtUser->get_result();
$result5 = $userResult->fetch_assoc();

if (!$result5) {
    echo '<script>alert("User not found!"); window.location.href = "logout.php";</script>';
    exit();
}

?>
    <form method="post" onsubmit="return validateForm()">
    <div class="main1">
        <div class="main3">
            <div class="main2">
                <div class="image">
                    <?php
                    $rn = $_GET['rn'];
                    $id = $_GET['id'];
                    switch ($id) {
                        case 'bike':
                            $query = "SELECT * FROM bikes WHERE rn = ?";
                            break;
                        case 'scooty':
                            $query = "SELECT * FROM scooty WHERE rn = ?";
                            break;
                        case 'car':
                            $query = "SELECT * FROM car WHERE rn = ?";
                            break;
                        default:
                            echo "Error Found!";
                    }

                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $rn);
                    $stmt->execute();
                    $data = $stmt->get_result();
                    $result = $data->fetch_assoc();
                    echo "<img src='" . $result['image'] . "'>";
                    $stmt->close();
                    ?>
                </div>
                <div class="rows1">
                    <div class="row">
                        <div class="heading">Name:</div>
                        <?php
                        if (isset($_SESSION['name'])) {
                            echo '<div class="input1"><input type="text" name="name" id="name" required readonly value="' . htmlspecialchars($result5['name'], ENT_QUOTES, 'UTF-8') . '"></div>';
                        } else {
                            echo '<div class="input1"><input type="text" name="name" id="name"></div>';
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="heading">Pickup Point:</div>
                        <div class="input1"><input type="text" name="pick" id="pick"></div>
                    </div>
                    <div class="row">
                        <div class="heading">Destination:</div>
                        <div class="input1"><input type="text" name="dest" id="dest"></div>
                    </div>
                    <div class="row">
                        <div class="heading">Contact No:</div>
                        <?php
                        if (isset($_SESSION['name'])) {
                            echo '<div class="input1"><input type="text" name="cn" id="cn" required value="' . htmlspecialchars($result5['mob'], ENT_QUOTES, 'UTF-8') . '"></div>';
                        } else {
                            echo '<div class="input1"><input type="text" name="cn" id="cn"></div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="rows2">
                    <div class="row">
                        <div class="heading">Journey Beginning Date:</div>
                        <div class="input1"><input type="date" name="bdate" id="bdate"></div>
                    </div>
                    <div class="row">
                        <div class="heading">Expected Return Date:</div>
                        <div class="input1"><input type="date" name="edate" id="edate"></div>
                    </div>
                    <div class="row">
                        <div class="heading">No of passengers:</div>
                        <div class="input1"><input type="number" name="nop" id="nop"></div>
                    </div>
                    <div class="row" >
                        <label id="tnc">
                            <input type="checkbox" id="terms" required>
                            I agree to the <a href="tnc.php" target="_blank">Terms and Conditions</a>
                        </label>
                    </div>
                    <div class="row" id="book">
                        <button type="submit" id="button1">Book Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

    <?php include 'foter.php'; ?>
</body>

</html>
<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $pick = trim($_POST['pick']);
    $dest = trim($_POST['dest']);
    $bdate = $_POST['bdate'];
    $edate = $_POST['edate'];
    $cn = trim($_POST['cn']);
    $nop = $_POST['nop'];
    $rn = $_GET['rn'];
    $status = 'Requested';

    // Check if any required field is empty
    if (!empty($name) && !empty($pick) && !empty($dest) && !empty($bdate) && !empty($edate) && !empty($cn) && !empty($nop)) {
        // Check for duplicate entries
        $duplicateQuery = "SELECT * FROM booking WHERE name=? AND pick=? AND dest=? AND bdate=? AND edate=? AND cn=? AND nop=? AND rn=?";
        $stmtDuplicate = $conn->prepare($duplicateQuery);
        $stmtDuplicate->bind_param("ssssssss", $name, $pick, $dest, $bdate, $edate, $cn, $nop, $rn);
        $stmtDuplicate->execute();
        $duplicateResult = $stmtDuplicate->get_result();
        
        if ($duplicateResult->num_rows == 0) {
            // Prepare and bind
            if ($stmt = $conn->prepare("INSERT INTO booking (name, pick, dest, bdate, edate, cn, nop, rn, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
                $stmt->bind_param("sssssssss", $name, $pick, $dest, $bdate, $edate, $cn, $nop, $rn, $status);
                // Execute the statement
                if ($stmt->execute()) {
                    // Fetch the booking ID of the inserted record
                    $bookingId = $conn->insert_id;
                    echo '<script>window.location.href = "bstatus.php?bookingid=' . $bookingId . '&image=' . $result['image'] . '";</script>';
                } else {
                    echo '<script>alert("Booking failed! Please try again.");</script>';
                }
                // Close the statement
                $stmt->close();
            } else {
                echo "Statement preparation failed: " . $conn->error;
            }
        } else {
            echo '<script>window.location.href = "index.php";</script>';
        }
        $stmtDuplicate->close();
    } else {
        echo '<script>alert("All fields are required!");</script>';
    }
}
?>
