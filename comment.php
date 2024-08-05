<?php
// Check if the user is logged in
/*$isLoggedIn = isset($_SESSION['name']) && $_SESSION['name'] === true;
$userName = $isLoggedIn ? $_SESSION['name'] : '';
$userMobile = $isLoggedIn ? $_SESSION['mobile'] : '';*/
$isLoggedIn = false;
if(isset($_SESSION['name'])){
    $isLoggedIn = true;
    $userName = $result5['name'];
    $userMobile = $result5['mob'];
}
?>

<div class="comment-section" id="comment-section1">
    <h1 class="heading">Comment Section</h1>
    <hr>
    <div class="comments-container">
        <?php
        include("mysql.php");
        $query = "SELECT * FROM comment";
        $data = mysqli_query($conn, $query);
        $total = mysqli_num_rows($data);
        if ($total > 0) {
            while ($result = mysqli_fetch_assoc($data)) {
                echo "
                <div class='comment-box'>
                    <div class='comment-header'>
                        <h3 class='name'>" . htmlspecialchars($result['name']) . "</h3>
                        <p class='date'>" . htmlspecialchars($result['date']) . "</p>
                    </div>
                    <p class='comment'>" . htmlspecialchars($result['comment']) . "</p>
                </div>
                ";
            }
        } else {
            echo "<p class='no-comments'>No Comments Found!</p>";
        }
        ?>
    </div>
    <div class="comment-form">
        <form method="post" action="">
            <?php if (!$isLoggedIn) { ?>
                <input type="text" id="name" name="name" placeholder="Your Name">
                <input type="text" id="mob" name="mob" placeholder="Your Mobile No">
            <?php } else { ?>
                <input type="hidden" id="name" name="name" value="<?php echo htmlspecialchars($userName); ?>">
                <input type="hidden" id="mob" name="mob" value="<?php echo htmlspecialchars($userMobile); ?>">
            <?php } ?>
            <textarea id="comment1" name="comment1" placeholder="Your Comment"></textarea>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $mob = $_POST['mob'];
    $comment1 = $_POST['comment1'];

    if ($name != "" && $mob != "" && $comment1 != "") {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO comment (name, mob, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $mob, $comment1);

        // Execute the statement
        if ($stmt->execute()) {
            echo '<script>window.location.href = "index.php?#comment-sections1";</script>';
            echo "<p class='success-message'>Comment Added Successfully!</p>";
        } else {
            echo "<p class='error-message'>Failed to Add Comment: " . $stmt->error . "</p>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<p class='error-message'>Please Fill All Fields</p>";
    }
}
?>
