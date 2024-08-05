<?php
session_start();
include "mysql.php";
if(isset($_SESSION['name'])){
    $name = $_SESSION['name'];
    echo "
    <style>
        #login, #signup {
            display: none;
        }
        #username, #logout, #mybooking{
            display: inline;
        }
    </style>";
    $query5 = "SELECT * FROM user_detail WHERE name='$name'";
    $data5 = $conn->query($query5);
    $result5 = $data5->fetch_assoc();
}
?>
<nav class="navbar">
    <div class="navbar-container">
        <a href="index.php" class="brand">Ready2Ride</a>
        <button class="toggle-button" id="nav-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
        <div class="navbar-links" id="navbar-links">
            <ul>
                <li class="navlist"><a href="index.php">Home</a></li>
                <li class="navlist" id="mybooking"><a href="mybooking.php">My Booking</a></li>
                <li class="navlist"><a href="Explorer.php?id=bike">Bike</a></li>
                <li class="navlist"><a href="Explorer.php?id=scooty">Scooty</a></li>
                <li class="navlist"><a href="Explorer.php?id=car">Car</a></li>
                <li class="navlist"><a href="about.php">About</a></li>
                <li class="navlist" id="login"><a href="login_page.php">Login</a></li>
                <li class="navlist" id="signup"><a href="signup.php">Sign Up</a></li>
                <li class="navlist" id="username"><a
                        href="account.php"><?php echo htmlspecialchars($result5['name']); ?></a></li>
                <li class="navlist" id="logout"><a href="logout.php"><img src="images/other/logout.png" alt="logout"
                            id="logout"></a></li>
            </ul>
        </div>
    </div>
</nav>