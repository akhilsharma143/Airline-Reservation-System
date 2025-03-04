<?php
include "connection.php";
session_start();

// Check if the form is submitted for updating
if (isset($_POST['Update'])) {
    $flight_no = $_POST['flight_no'];
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $dep_date = $_POST['dep_date'];
    $arr_date = $_POST['arr_date'];
    $dep_time = $_POST['dep_time'];
    $arr_time = $_POST['arr_time'];
    $seats_eco = $_POST['seats_eco'];
    $seats_bus = $_POST['seats_bus'];
    $price_eco = $_POST['price_eco'];
    $price_bus = $_POST['price_bus'];

    $updateSql = "UPDATE flights SET from_city = ?, to_city = ?, departure_date = ?, arrival_date = ?, departure_time = ?, arrival_time = ?, seats_economy = ?, seats_business = ?, price_economy = ?, price_business = ? WHERE flight_no = ?";
    $updateStmt = mysqli_prepare($conn, $updateSql);

    if (!$updateStmt) {
        die('Error preparing update statement: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($updateStmt, "sssssssiiis", $origin, $destination, $dep_date, $arr_date, $dep_time, $arr_time, $seats_eco, $seats_bus, $price_eco, $price_bus, $flight_no);

    if (!mysqli_stmt_execute($updateStmt)) {
        die('Error executing update statement: ' . mysqli_error($conn));
    }

    $affected_rows = mysqli_stmt_affected_rows($updateStmt);
    mysqli_stmt_close($updateStmt);

    if ($affected_rows > 0) {
        $msg = "success";
    } else {
        $msg = "failed";
    }
    header("Location: modify_flight_details.php?flight_no=$flight_no&msg=$msg");
    exit();
    
}


?>


<html>
	<head>
		<title>
			Add Flight Schedule Details
		</title>
		<style>
		    body {
            background-image: url("images/fly.jpg");
            background-size: cover; 
            background-repeat: no-repeat; 
            background-attachment: fixed; 
        }

        form {
            margin: 100px auto;
            padding: 5px;
            border-radius: 15px;
            box-shadow: 4px 5px 8px 2px black;
            background-color: rgba(255, 255, 255, 0.4);
            max-width: 450px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
        
            margin-bottom: 4px;
            font-size: 16px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #00FFFF;
            color: black;
          margin-top:5px;
            font-size: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #00BFFF;
        }
		</style>
		     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<!--NavBar-->
<header>
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a href="#" class="navbar-brand text-white"><img src="images/logo.png" id="logo" alt=""> ROYAL AIRWAYS</a>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
   
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="Index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#About">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="contact.php">Contact Us</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="registerDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Register <i class="fas fa-user-plus"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="registerDropdown">
                <a class="dropdown-item text-dark" href="new_admin.php?type=admin">Register as Admin</a>
                <a class="dropdown-item text-dark" href="new_user.php?type=passenger">Register as Passenger</a>
            </div>
        </li>
         <li class="nav-item">
           <a href="login.php" class="nav-link text-white">Book Flights <i class="fas fa-user"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
</header>
    <form action="modify_flight_details.php" method="post">
        <h2>MODIFY FLIGHT SCHEDULE DETAILS</h2>

        <?php
        // Display messages or errors if needed
        if (isset($_GET['msg']) && $_GET['msg'] == 'success') {
            echo "<strong style='color: green'>Flight details have been successfully updated.</strong><br><br>";
        } else if (isset($_GET['msg']) && $_GET['msg'] == 'failed') {
            echo "<strong style='color: red'>*Failed to update flight details. Please try again.</strong><br><br>";
        }
        ?>

        <label for="flight_no">Flight Number:</label>
        <input type="text" id="flight_no" name="flight_no" value="<?php echo isset($flight_no) ? $flight_no : ''; ?>" required>

       <label for="origin">Origin:</label>
<select id="origin" name="origin" required>
    <option value="">Select Origin</option>
    <?php
    $origins = array(
        "Chhatrapati Shivaji International Airport, Mumbai",
        "Kempegowda International Airport, Bengaluru",
        "Netaji Subhas Chandra Bose International Airport, Kolkata",
        "Indira Gandhi International Airport, New Delhi",
        "Chandigarh International Airport, Mohali"
    );

    foreach ($origins as $origin) {
        echo "<option value=\"$origin\">$origin</option>";
    }
    ?>
</select>

<label for="destination">Destination:</label>
<select id="destination" name="destination" required>
    <option value="">Select Destination</option>
    <?php
    $destinations = array(
        "Chhatrapati Shivaji International Airport, Mumbai",
        "Kempegowda International Airport, Bengaluru",
        "Netaji Subhas Chandra Bose International Airport, Kolkata",
        "Indira Gandhi International Airport, New Delhi",
        "Chandigarh International Airport, Mohali"
    );

    foreach ($destinations as $destination) {
        echo "<option value=\"$destination\">$destination</option>";
    }
    ?>
</select>
       
        <label for="dep_date">Departure Date:</label>
        <input type="date" id="dep_date" name="dep_date" value="<?php echo isset($dep_date) ? $dep_date : ''; ?>" required>

        <label for="arr_date">Arrival Date :</label>
        <input type="date" id="arr_date" name="arr_date" value="<?php echo isset($arr_date) ? $arr_date : ''; ?>" required>

        <label for="dep_time">Departure Time:</label>
        <input type="time" id="dep_time" name="dep_time" value="<?php echo isset($dep_time) ? $dep_time : ''; ?>" required>

        <label for="arr_time">Arrival Time :</label>
        <input type="time" id="arr_time" name="arr_time" value="<?php echo isset($arr_time) ? $arr_time : ''; ?>" required>

        <label for="seats_eco">Number of Seats in Economy Class:</label>
		<input type="number" id="seats_eco" name="seats_eco" value="<?php echo isset($seats_eco) ? $seats_eco : ''; ?>" required>

        <label for="seats_bus">Number of Seats in Business Class:</label>
		<input type="number" id="seats_bus" name="seats_bus"  value="<?php echo isset($seats_bus) ? $seats_bus: ''; ?>" required>

        <label for="price_eco">Ticket Price (Economy Class):</label>
		<input type="number" id="price_eco" name="price_eco"  value="<?php echo isset($price_eco) ? $price_eco: ''; ?>" required>
 
        <label for="price_bus">Ticket Price (Business Class):</label>
		<input type="number" id="price_bus" name="price_bus" value="<?php echo isset($price_bus) ? $price_bus: ''; ?>" required>

        <input type="hidden" name="flight_no" value="<?php echo $flight_no; ?>">
        <input type="submit" value="Update" name="Update">
    </form>
<!-- Footer Section -->
<footer class="bg-dark text-white">
    <div class="container">
        <div class="row py-4">
            <div class="col-md-6">
                <h5>Connect with us</h5>
                <p>Follow us on social media for updates and news</p>
              
                <a href="https://www.facebook.com/profile.php?id=100045212453022" target="_blank" class="text-white mr-2"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com/?lang=en-in" target="_blank" class="text-white mr-2"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com/_akhil__143/#" target="_blank" class="text-white mr-2"><i class="fab fa-instagram"></i></a>
                <a href="https://www.youtube.com/" target="_blank" class="text-white mr-2"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="col-md-6">
                <h5>Contact Information</h5>
                <p>Email: info@royalairways.com</p>
                <p>Phone:8219366869</p>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white text-center py-2">
        <p>&copy; 2023 Royal Airways. All rights reserved.</p>
    </div>
</footer>
</body>
</html>