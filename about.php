<!-- Index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>
    <link rel="stylesheet" href="css/navCSS.css">
    <link rel="stylesheet" href="css/foterCSS.css">
    <link rel="stylesheet" href="css/aboutCSS.css">
    <link rel="stylesheet" href="css/nav1.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="about-section">
        <div class="text">
            <h1>About Us Page</h1>
            <p>Welcome to “Ready2Ride” – your trusted partner for convenient and hassle-free car and bike rentals.
                Whether you’re exploring a new city, embarking on a road trip, or simply need a reliable ride, we’ve got
                you covered.</p>
            <p>At “Ready2Ride”, we believe that mobility should be accessible to everyone. Our journey began with a
                vision: to transform the way people move. With a passion for adventure and a commitment to quality
                service, we set out to create a seamless rental experience.</p>
        </div>
    </div>

    <h2 style="text-align:center">Our Team</h2>
    <div class="row">
        <div class="column">
            <div class="card">
                <img src="images/person/tushar.jpg" alt="Tushar Garg" style="width:100%">
                <div class="container">
                    <h2>Tushar Garg</h2>
                    <p class="title">CEO & CTO</p>
                    <p>Tushar is the tech wizard who keeps our wheels turning smoothly. Whether it’s optimizing our booking system, his codes power our engine.</p>
                    <p><a href="mailto:tushargarg180@gmail.com"><button class="button">Contact</button></a></p>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="card">
                <img src="images/person/prajjwal.png" alt="Prajwal Kanojiya" style="width:100%">
                <div class="container">
                    <h2>Prajwal Kanojiya</h2>
                    <p class="title">Marketing Head</p>
                    <p>Prajwal is the visual maestro behind our brand’s aesthetics. With an eye for elegance and a flair for design, and automotive designer. He transforms ideas into stunning visuals.</p>
                    <p><a href="mailto:prajwalkanojiya@gmail.com"><button class="button">Contact</button></a></p>
                </div>
            </div>
        </div>

        <div class="column">
            <div class="card">
                <img src="images/person/anuj.jpg" alt="Anuj Rana" style="width:100%">
                <div class="container">
                    <h2>Anuj Rana</h2>
                    <p class="title">Content Writer</p>
                    <p>When you read our blog posts or explore our website, you’re hearing Anuj’s voice. He dives deep into topics, unearthing fascinating facts and translating them into relatable content.</p>
                    <p><a href="mailto:anujrana123@gmail.com"><button class="button">Contact</button></a></p>
                </div>
            </div>
        </div>
    </div>
    <?php include 'foter.php'; ?>
    <script src="navJS.js"></script>
</body>
</html>
