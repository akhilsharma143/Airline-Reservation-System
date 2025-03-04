<?php
include "connection.php";
session_start();

if (isset($_POST['Submit'])) {
    $data_missing = array();

    if (empty($_POST['flight_no'])) {
        $data_missing[] = 'Flight No.';
    } else {
        $flight_no = trim($_POST['flight_no']);
    }

    if (empty($_POST['origin'])) {
        $data_missing[] = 'Origin';
    } else {
        $origin = $_POST['origin'];
    }

    if (empty($_POST['destination'])) {
        $data_missing[] = 'Destination';
    } else {
        $destination = $_POST['destination'];
    }

    if (empty($_POST['dep_date'])) {
        $data_missing[] = 'Departure Date';
    } else {
        $dep_date = $_POST['dep_date'];
    }

    if (empty($_POST['arr_date'])) {
        $data_missing[] = 'Arrival Date';
    } else {
        $arr_date = $_POST['arr_date'];
    }

    if (empty($_POST['dep_time'])) {
        $data_missing[] = 'Departure Time';
    } else {
        $dep_time = $_POST['dep_time'];
    }

    if (empty($_POST['arr_time'])) {
        $data_missing[] = 'Arrival Time';
    } else {
        $arr_time = $_POST['arr_time'];
    }

    if (empty($_POST['seats_eco'])) {
        $data_missing[] = 'Seats(Economy)';
    } else {
        $seats_eco = $_POST['seats_eco'];
    }

    if (empty($_POST['seats_bus'])) {
        $data_missing[] = 'Seats(Business)';
    } else {
        $seats_bus = $_POST['seats_bus'];
    }

    if (empty($_POST['price_eco'])) {
        $data_missing[] = 'Price(Economy)';
    } else {
        $price_eco = $_POST['price_eco'];
    }

    if (empty($_POST['price_bus'])) {
        $data_missing[] = 'Price(Business)';
    } else {
        $price_bus = $_POST['price_bus'];
    }

    if (empty($data_missing)) {
        $query = "INSERT INTO flights (flight_no, from_city, to_city, departure_date, arrival_date, departure_time, arrival_time, seats_economy, seats_business, price_economy, price_business) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssssssiidd", $flight_no, $origin, $destination, $dep_date, $arr_date, $dep_time, $arr_time, $seats_eco, $seats_bus, $price_eco, $price_bus);

            mysqli_stmt_execute($stmt);

            $affected_rows = mysqli_stmt_affected_rows($stmt);

            mysqli_stmt_close($stmt);

            if ($affected_rows == 1) {
                header("location: add_flight_details.php?msg=success");
                exit();
            } else {
                $error_message = mysqli_error($conn);
                mysqli_close($conn);
                header("location: add_flight_details.php?msg=failed&error=" . urlencode($error_message));
                exit();
            }
        } else {
            $error_message = mysqli_error($conn);
            mysqli_close($conn);
            header("location: add_flight_details.php?msg=failed&error=" . urlencode($error_message));
            exit();
        }
    } else {
        echo "The following data fields were empty! <br>";
        foreach ($data_missing as $missing) {
            echo $missing . "<br>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Flight Schedule Details</title>
    <style>
        body {
            background-image: url("images/fly2.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        form {
            margin: 100px auto;
            padding: 2px;
            border-radius: 15px;
            box-shadow: 2px 5px 8px 0.2px black;
            background-color: rgba(255, 255, 255, 0.4);
            max-width: 600px;
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
        }
        input[type="submit"] {
            background-color: #00FFFF;
            color: black;
            margin-top: 5px;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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
    <form action="add_flight_details.php" method="post">
        <h2>ENTER THE FLIGHT SCHEDULE DETAILS</h2>
        <?php
            if (isset($_GET['msg']) && $_GET['msg'] == 'success') {
                echo "<strong style='color: green'>The Flight Schedule has been successfully added.</strong><br><br>";
            } else if (isset($_GET['msg']) && $_GET['msg'] == 'failed') {
                echo "<strong style='color: red'>*Invalid Flight Schedule Details, please enter again.</strong><br><br>";
                if (isset($_GET['error'])) {
                    echo "<strong style='color: red'>Error: " . htmlspecialchars($_GET['error']) . "</strong><br><br>";
                }
            }
        ?>
    <label for="flight_no">Flight Number:</label>
    <input type="text" id="flight_no" name="flight_no" required>
    
    <hr>
    
	<div class="form-row">
    <div class="form-group col-md-6">
        <label for="origin">Origin:</label>
        <select id="origin" name="origin" class="form-control" required>
            <option value="">Select Origin</option>
            <option value="Chhatrapati Shivaji International Airport,Mumbai">Chhatrapati Shivaji International Airport,Mumbai</option>
            <option value="Kempegowda International Airport,Bengluru">Kempegowda International Airport,Bengluru</option>
            <option value="Netaji Subhas Chandra Bose International Airport,Kolkata">Netaji Subhas Chandra Bose International Airport,Kolkata</option>
			<option value="Indira Gandhi International Airport,New Delhi">Indira Gandhi International Airport,New Delhi</option>
			<option value="Chandigarh International Airport,Mohali">Chandigarh International Airport,Mohali</option>
           
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="destination">Destination:</label>
        <select id="destination" name="destination" class="form-control" required>
		<option value="">Select Destination</option>
            <option value="Chhatrapati Shivaji International Airport,Mumbai">Chhatrapati Shivaji International Airport,Mumbai</option>
            <option value="Kempegowda International Airport,Bengluru">Kempegowda International Airport,Bengluru</option>
            <option value="Netaji Subhas Chandra Bose International Airport,Kolkata">Netaji Subhas Chandra Bose International Airport,Kolkata</option>
			<option value="Indira Gandhi International Airport,New Delhi">Indira Gandhi International Airport,New Delhi</option>
			<option value="Chandigarh International Airport,Mohali">Chandigarh International Airport,Mohali</option>
           
        </select>
    </div>
</div>

    
    <hr>
    
	<div class="form-row">
        <div class="form-group col-md-6">
            <label for="dep_date">Departure Date:</label>
            <input type="date" id="dep_date" name="dep_date" class="form-control" required>
        </div>
        <div class="form-group col-md-6">
            <label for="arr_date">Arrival Date:</label>
            <input type="date" id="arr_date" name="arr_date" class="form-control" required>
        </div>
    </div>
    
    <hr>
    
	<div class="form-row">
        <div class="form-group col-md-6">
            <label for="dep_time">Departure Time:</label>
			<input type="time" id="dep_time" name="dep_time" class="form-control" required>
        </div>
        <div class="form-group col-md-6">
		<label for="arr_time">Arrival Time:</label>
			<input type="time" id="arr_time" name="arr_time" class="form-control" required>
        </div>
    </div>
    
    
    <hr>
    <div class="form-row">
        <div class="form-group col-md-6">
		<label for="seats_eco">Number of Seats in Economy Class:</label>
		<input type="number" id="seats_eco" name="seats_eco" class="form-control" required>
        </div>
	
        <div class="form-group col-md-6">
		 
		<label for="seats_bus">Number of Seats in Business Class:</label>
		<input type="number" id="seats_bus" name="seats_bus"  class="form-control" required>
        </div>
    </div>
    
    <hr>
	<div class="form-row">
        <div class="form-group col-md-6">
		<label for="price_eco">Ticket Price (Economy Class):</label>
		<input type="number" id="price_eco" name="price_eco" class="form-control" required>
        </div>
	
        <div class="form-group col-md-6">
		<label for="price_bus">Ticket Price (Business Class):</label>
		<input type="number" id="price_bus" name="price_bus"class="form-control" required>
        </div>
    </div>
    <input type="submit" value="Submit" name="Submit">
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