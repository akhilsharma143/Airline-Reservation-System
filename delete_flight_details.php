<?php
include "connection.php";
session_start();

if (isset($_POST['Delete'])) {
    $flight_no = $_POST['flight_no'];

    $deletesql = "DELETE FROM flights WHERE flight_no = ?";
    $DeleteStmt = mysqli_prepare($conn, $deletesql);

    if (!$DeleteStmt) {
        die('Error preparing Delete statement: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($DeleteStmt, "s", $flight_no);

    if (!mysqli_stmt_execute($DeleteStmt)) {
        die('Error executing Delete statement: ' . mysqli_error($conn));
    }

    $affected_rows = mysqli_stmt_affected_rows($DeleteStmt);
    mysqli_stmt_close($DeleteStmt);

    if ($affected_rows > 0) {
        header("Location: delete_flight_details.php?flight_no=$flight_no&msg=success");
        exit();
    } else {
        header("Location: delete_flight_details.php?flight_no=$flight_no&msg=failed");
        exit();
    }
}

if (isset($_GET['flight_no'])) {
    $flight_no = $_GET['flight_no'];

    $query = "SELECT * FROM flights WHERE flight_no = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $flight_no);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($result && $row) {
      
        $origin = $row['from_city'];
        $destination = $row['to_city'];
        $dep_date = $row['departure_date'];
        $arr_date = $row['arrival_date'];
        $dep_time = $row['departure_time'];
        $arr_time = $row['arrival_time'];
        $seats_eco = $row['seats_economy'];
        $seats_bus = $row['seats_business'];
        $price_eco = $row['price_economy'];
        $price_bus = $row['price_business'];
    } else {
        echo "Error fetching flight details.";
    }
}
?>

            <html>
	<head>
		<title>
			Delete Flight Schedule Details
		</title>
		<style>
		    body {
                background-image: url("images/fly2.jpg");
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
        footer {
    position: absolute;
    bottom: 0;
    width: 100%;
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
    <form action="delete_flight_details.php" method="post">
        <h2>Delete FLIGHT  DETAILS</h2>

        <?php
   
        if (isset($_GET['msg']) && $_GET['msg'] == 'success') {
            echo "<strong style='color: green'>Flight details have been successfully deleted.</strong><br><br>";
        } else if (isset($_GET['msg']) && $_GET['msg'] == 'failed') {
            echo "<strong style='color: red'>*Failed to delete flight details. Please try again.</strong><br><br>";
        }
        ?>

    <label for="flight_no">Flight Number:</label>
        <input type="text" id="flight_no" name="flight_no" value="<?php echo isset($flight_no) ? $flight_no : ''; ?>" required>

        <input type="hidden" name="flight_no" value="<?php echo $flight_no; ?>">
        <input type="submit" value="Delete" name="Delete">
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