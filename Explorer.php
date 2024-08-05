<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorer_Bikes</title>
    <link rel="stylesheet" href="css/navCSS.css">
    <link rel="stylesheet" href="css/foterCSS.css">
    <link rel="stylesheet" href="css/Explorer_BikeCSS.css">
    <link rel="stylesheet" href="css/exploreCSS.css">
    <link rel="stylesheet" href="css/nav1.css">
</head>

<body>
    <?php include("navbar.php") ?>
    <div class="bikes">
        <?php
        include("mysql.php");
        $id=$_GET['id'];
        switch($id){
            case 'bike':
                $query = "SELECT * FROM bikes";
                break;
            case 'scooty':
                $query = "SELECT * FROM scooty";
                break;
            case 'car':
                $query = "SELECT * FROM car";
                break;
            default:
                echo"Error Found!";
        }
        $data = mysqli_query($conn, $query);
        $total = mysqli_num_rows($data);
        if ($total > 0) {
            echo '<div class="bikes">';
            while ($result = mysqli_fetch_assoc($data)) {
                echo '
                <div class="product">
                    <div class="image">
                        <a href="more_details.php?rn='.$result['rn'].' & id='.$id.'"><img src="'.$result['image'].'"></a>
                    </div>
                    <ul class="detail">
                        <li>RPK: ' . htmlspecialchars($result['price'], ENT_QUOTES, 'UTF-8') . ' KM </li>
                    </ul>
                    <div class="action">
                        <h1 class="button"><a href="bookingpage.php?rn='.$result['rn'].'& id='.$id.'">Book Now</a></h1>
                    </div>
                </div>';
            }
            echo '</div>';
        } else {
            echo "No Record Found!";
        }
        ?>
    </div>
    <?php include("foter.php") ?>
</body>

</html>