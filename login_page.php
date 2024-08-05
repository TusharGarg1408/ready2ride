<?php
    include 'mysql.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login_Page</title>
    <link rel="stylesheet" href="css/navCSS.css">
    <link rel="stylesheet" href="css/foterCSS.css">
    <link rel="stylesheet" href="css/loginCSS.css">
    <link rel="stylesheet" href="css/nav1.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="loginsec">
        <div class="loginsection">
            <h1>Ready2Ride</h1>
            <h3>Enter your login credentials</h3>
            <form method="post">
                <label for="name">
                    UserName:
                </label>
                <input type="text" id="name" name="name" placeholder="Enter your Username" required>

                <label for="password">
                    Password:
                </label>
                <input type="password" id="password" name="password" placeholder="Enter your Password" required>

                <div class="wrap">
                    <button type="submit" id="submit" name="submit">
                        Submit
                    </button>
                </div>
            </form>
            <p>Not registered?
                <a href="signup.php" style="text-decoration: none;">
                    Create an account
                </a>
            </p>
            <p>Admin
                <a href="admin/index.php" style="text-decoration: none;">
                    Login
                </a>
            </p>
            <div id="message">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                    $name = $_POST['name'];
                    $password = $_POST['password'];
                    if (!empty($name) && !empty($password)) {
                        $query = "SELECT * FROM user_detail WHERE name='$name' AND password='$password'";
                        $data = mysqli_query($conn, $query);
                        $total = mysqli_num_rows($data);
                        echo$total;
                        if ($total == 1) {
                            $_SESSION['name'] = $name;
                            header('location: index.php');
                            exit();  // Make sure to exit after redirection
                        } else {
                            echo 'Login failed';
                        }
                    } else {
                        echo 'Please fill in the details.';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php include 'foter.php'; ?>
    <script src="navJS.js"></script>
</body>
</html>
