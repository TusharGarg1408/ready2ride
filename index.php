<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/navCSS.css">
    <link rel="stylesheet" href="css/nav1.css">
    <link rel="stylesheet" href="css/foterCSS.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/commentCSS.css">
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="header">
        <div class="hero">
        <?php
        if(isset($_SESSION['name'])){
            echo'<h1>Welcome '.$result5['name'].' Ready For Trip!</h1>';
        }
        else{
            echo'<h1>Welcome to Vehicle Booking</h1>';
        }
        ?>
            <p>Find your perfect ride</p>
            <a href="#explore" class="cta-button">Explore Now</a>
        </div>
    </div>
    <div class="main-content">
        <section id="explore" class="explore-section">
            <h2>Explore Our Vehicles</h2>
            <div class="vehicle-card">
                <img src="images/bikes/bike.png" alt="Bike">
                <div class="card-content">
                    <h3>Bikes</h3>
                    <p>Discover our range of bikes for every journey.</p>
                    <a href="Explorer.php?id=bike" class="card-button">Explore Bikes</a>
                </div>
            </div>
            <div class="vehicle-card">
                <img src="images/scooty/jupiter125.png" alt="Scooty">
                <div class="card-content">
                    <h3>Scooty</h3>
                    <p>Check out our scooty selection for smooth rides.</p>
                    <a href="Explorer.php?id=scooty" class="card-button">Explore Scooty</a>
                </div>
            </div>
            <div class="vehicle-card">
                <img src="images/car/car.png" alt="Car">
                <div class="card-content">
                    <h3>Cars</h3>
                    <p>Browse through our collection of cars for every need.</p>
                    <a href="Explorer.php?id=car" class="card-button">Explore Cars</a>
                </div>
            </div>
        </section>
    </div>
    <?php include 'comment.php'; ?>
    <?php include 'foter.php'; ?>
    <script src="js/navJS.js"></script>
</body>

</html>