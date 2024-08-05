<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike Details</title>
    <link rel="stylesheet" href="css/navCSS.css">
    <link rel="stylesheet" href="css/nav1.css">
    <link rel="stylesheet" href="css/foterCSS.css">
    <link rel="stylesheet" href="css/more_detailCSS.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="detail1">
        <?php
        include("mysql.php");
        if (isset($_GET['rn'])){
            $rn=$_GET['rn'];
            $id=$_GET['id'];
            switch($id){
                case 'bike':
                    $query = "SELECT * FROM bikes WHERE rn = '$rn'";
                    break;
                case 'scooty':
                    $query = "SELECT * FROM scooty WHERE rn = '$rn'";
                    break;
                case 'car':
                    $query = "SELECT * FROM car WHERE rn = '$rn'";
                    break;
                default:
                    echo"Error Found!";
            }
            $data = mysqli_query($conn, $query);
            if ($data && $result = $data->fetch_assoc()) {
                echo '
                <div class="product-details">
                    <div class="image">
                        <img src="'.$result['image'].'">
                    </div>
                    <div class="detail1">
                    <ul class="detail">
                        <li>Model: '.$result['model']. '</li>
                        <li>Brand: '.$result['brand']. '</li>
                        <li>Engine Power: '.$result['engine']. '</li>
                        <li>Millage: '.$result['millage']. ' KM/L</li>
                        <li>Registration Date: '.$result['rd']. '</li>
                        <li>Registration No: '.$result['rn']. '</li>
                        <li>Insurance Valid Upto: '.$result['insurance']. '</li>
                        <li>Pollution Valid Upto: '.$result['pollution']. '</li>
                        <li>Rate Per KM: '.$result['price']. ' KM</li>
                    </ul>
                    <div class="action">
                        <h1 class="button"><a href="bookingpage.php?rn='.$result['rn'].'& id='.$id.'">Book Now</a></h1>
                    </div>
                    </div>
                </div>';
            }
            else {
                echo "No details found!";
            }
        }
        else {
            echo "Invalid request!";
        }
        ?>
    </div>
    <?php include 'foter.php'; ?>
</body>

</html>