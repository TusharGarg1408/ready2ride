<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link rel="stylesheet" href="css/navCSS.css">
    <link rel="stylesheet" href="css/foterCSS.css">
    <link rel="stylesheet" href="css/signupCSS.css">
    <link rel="stylesheet" href="css/nav1.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="signupsection">
        <div id="sign">
            <h1>Ready2Ride</h1>
            <h3>Enter your Details For Sign-Up</h3>
            <div class="signup">
                <form method="post" action="">
                    <div class="fc">
                        <label for="name1">Full Name:</label>
                        <input type="text" id="name1" name="name1" placeholder="Enter your Username" required>
                    </div>
                    <div class="fc">
                        <label for="mob">Mobile NO:</label>
                        <input type="text" id="mob" name="mob" placeholder="Enter Your Mobile No" required>
                    </div>
                    <div class="fc">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" placeholder="Enter Your Email" required>
                    </div>
                    <div class="fc">
                        <label for="aid">Aadhar No:</label>
                        <input type="number" id="aid" name="aid" placeholder="Enter Your Aadhar No" required>
                    </div>
                    <div class="fc">
                        <label for="state">State:</label>
                        <select id="state" name="state" required onchange="updateDistricts()">
                            <option value="" disabled selected>Select Your State</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="West Bengal">West Bengal</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                            <option value="Daman and Diu">Daman and Diu</option>
                            <option value="Lakshadweep">Lakshadweep</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Puducherry">Puducherry</option>
                            <option value="Ladakh">Ladakh</option>
                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                        </select>
                    </div>
                    <div class="fc">
                        <label for="district">District:</label>
                        <select id="district" name="district" required>
                            <option value="" disabled selected>Select Your District</option>
                        </select>
                    </div>
                    <div class="fc">
                        <label for="village">Village/Block:</label>
                        <input type="text" id="village" name="village" placeholder="Enter Your Village" required>
                    </div>
                    <div class="fc">
                        <label for="street">Street:</label>
                        <input type="text" id="street" name="street" placeholder="Enter Your Street" required>
                    </div>
                    <div class="fc">
                        <label for="pincode">Pincode:</label>
                        <input type="number" id="pincode" name="pincode" placeholder="Enter Your Pincode" required>
                    </div>
                    <div class="fc">
                        <label for="password">Password:</label>
                        <input type="text" id="password" name="password" placeholder="Enter your Password" required>
                    </div>
                    <div class="wrap">
                        <button type="submit">Submit</button>
                    </div>
                </form>
                <p>Already registered? <a href="login_page.php" style="text-decoration: none;">Login</a></p>
            </div>
        </div>
    </div>
    <?php include 'foter.php'; ?>
    <script src="navJS.js"></script>
    <script>
    const stateDistrictMap = {
        "Andhra Pradesh": ["Anantapur", "Chittoor", "East Godavari", "Guntur"],
        "Arunachal Pradesh": ["Anjaw", "Changlang", "Dibang Valley", "East Kameng"],
        "Assam": ["Baksa", "Barpeta", "Biswanath", "Bongaigaon"],
        "Bihar": ["Araria", "Arwal", "Aurangabad", "Banka"],
        "Chhattisgarh": ["Balod", "Baloda Bazar", "Balrampur", "Bastar"],
        "Goa": ["North Goa", "South Goa"],
        "Gujarat": ["Ahmedabad", "Amreli", "Anand", "Aravalli"],
        "Haryana": ["Ambala", "Bhiwani", "Charkhi Dadri", "Faridabad"],
        "Himachal Pradesh": ["Bilaspur", "Chamba", "Hamirpur", "Kangra"],
        "Jharkhand": ["Bokaro", "Chatra", "Deoghar", "Dhanbad"],
        "Karnataka": ["Bagalkot", "Ballari", "Belagavi", "Bengaluru Urban"],
        "Kerala": ["Alappuzha", "Ernakulam", "Idukki", "Kannur"],
        "Madhya Pradesh": ["Agar Malwa", "Alirajpur", "Anuppur", "Ashoknagar"],
        "Maharashtra": ["Ahmednagar", "Akola", "Amravati", "Aurangabad"],
        "Manipur": ["Bishnupur", "Chandel", "Churachandpur", "Imphal East"],
        "Meghalaya": ["East Garo Hills", "East Jaintia Hills", "East Khasi Hills", "North Garo Hills"],
        "Mizoram": ["Aizawl", "Champhai", "Kolasib", "Lawngtlai"],
        "Nagaland": ["Dimapur", "Kiphire", "Kohima", "Longleng"],
        "Odisha": ["Angul", "Balangir", "Balasore", "Bargarh"],
        "Punjab": ["Amritsar", "Barnala", "Bathinda", "Faridkot"],
        "Rajasthan": ["Ajmer", "Alwar", "Banswara", "Baran"],
        "Sikkim": ["East Sikkim", "North Sikkim", "South Sikkim", "West Sikkim"],
        "Tamil Nadu": ["Ariyalur", "Chengalpattu", "Chennai", "Coimbatore"],
        "Telangana": ["Adilabad", "Bhadradri Kothagudem", "Hyderabad", "Jagtial"],
        "Tripura": ["Dhalai", "Gomati", "Khowai", "North Tripura"],
        "Uttar Pradesh": ["Agra", "Aligarh", "Ambedkar Nagar", "Amethi"],
        "Uttarakhand": ["Almora", "Bageshwar", "Chamoli","Dehradun", "Champawat"],
        "West Bengal": ["Alipurduar", "Bankura", "Birbhum", "Cooch Behar"],
        "Andaman and Nicobar Islands": ["Nicobar", "North and Middle Andaman", "South Andaman"],
        "Chandigarh": ["Chandigarh"],
        "Dadra and Nagar Haveli": ["Dadra and Nagar Haveli"],
        "Daman and Diu": ["Daman", "Diu"],
        "Lakshadweep": ["Lakshadweep"],
        "Delhi": ["Central Delhi", "East Delhi", "New Delhi", "North Delhi"],
        "Puducherry": ["Karaikal", "Mahe", "Puducherry", "Yanam"],
        "Ladakh": ["Kargil", "Leh"],
        "Jammu and Kashmir": ["Anantnag", "Bandipora", "Baramulla", "Budgam"]
    };

    function updateDistricts() {
        const stateSelect = document.getElementById('state');
        const districtSelect = document.getElementById('district');
        const selectedState = stateSelect.value;

        // Clear existing options in the district dropdown
        districtSelect.innerHTML = '<option value="" disabled selected>Select Your District</option>';

        if (selectedState && stateDistrictMap[selectedState]) {
            // Populate district dropdown based on selected state
            stateDistrictMap[selectedState].forEach(district => {
                const option = document.createElement('option');
                option.value = district;
                option.textContent = district;
                districtSelect.appendChild(option);
            });
        }
    }
    </script>
</body>

</html>
<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include("mysql.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name1'];
    $mob = $_POST['mob'];
    $email = $_POST['email'];
    $aid = $_POST['aid'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $village = $_POST['village'];
    $street = $_POST['street'];
    $pincode = $_POST['pincode'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $sql = "INSERT INTO user_detail (name, mob, email, aid, state, district, village, street, pincode, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Initialize a statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind parameters to the statement
    $stmt->bind_param("sissssssss", $name, $mob, $email, $aid, $state, $district, $village, $street, $pincode, $password);

    // Execute the statement
    if ($stmt->execute()) {
        //echo "Data inserted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>