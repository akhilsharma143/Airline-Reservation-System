<?php
  session_start();
  include('connection.php');
?>
<html>
<head>
    <title>View Available Flights</title>
    <style>
        body {
            background-image: url("images/fly2.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;

        }

        form {
            margin: 100px auto;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 4px 5px 8px 2px black;
            background-color: rgba(255, 255, 255, 0.8);
            max-width: 600px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #00FFFF;
            color: black;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px;
        }

        input[type="submit"]:hover {
            background-color: #00BFFF;
        }

        .flight-list-horizontal {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .flight-item-horizontal {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            margin: 10px;
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        .navbar-brand img {
            height: 40px;
            width: auto;
        }
        .footer {
            background-color: #343a40; /* Bootstrap dark background */
            color: white;
            margin-top: 900px;
          
        }

        footer a {
            color: white;
            text-decoration: none;
        }

        footer a:hover {
            color: #00BFFF;
            text-decoration: underline;
        }

        .social-icons a {
            margin-right: 15px;
            font-size: 1.5em;
        }

        .footer-contact p {
            margin-bottom: 5px;
        }

        .footer-bottom {
            background-color: #23272b; /* Slightly darker shade */
            padding: 10px 0;
            text-align: center;
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
    
    <?php
    if (isset($_POST['Search'])) {
        $data_missing = array();

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
            $dep_date = trim($_POST['dep_date']);
        }

        if (empty($_POST['psngr'])) {
            $data_missing[] = 'No. of Passengers';
        } else {
            $no_of_pass = trim($_POST['psngr']);
        }

        if (empty($_POST['class'])) {
            $data_missing[] = 'Class';
        } else {
            $class = trim($_POST['class']);
        }

        if (empty($data_missing)) {
            $_SESSION['no_of_pass'] = $no_of_pass;
            $_SESSION['class'] = $class;
            $count = 1;
            $_SESSION['count'] = $count;
            $_SESSION['journey_date'] = $dep_date;

            $query = "";
            $price_column = "";
            $seats_column = "";

            if ($class == "economy") {
                $query = "SELECT flight_no, from_city, to_city, departure_date, departure_time, arrival_date, arrival_time, price_economy FROM flights WHERE from_city=? AND to_city=? AND departure_date=? AND seats_economy>=? ORDER BY departure_time";
                $price_column = "price_economy";
                $seats_column = "seats_economy";
            } elseif ($class == "business") {
                $query = "SELECT flight_no, from_city, to_city, departure_date, departure_time, arrival_date, arrival_time, price_business FROM flights WHERE from_city=? AND to_city=? AND departure_date=? AND seats_business>=? ORDER BY departure_time";
                $price_column = "price_business";
                $seats_column = "seats_business";
            }

            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sssi", $origin, $destination, $dep_date, $no_of_pass);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $flight_no, $from_city, $to_city, $departure_date, $departure_time, $arrival_date, $arrival_time, $price);
            mysqli_stmt_store_result($stmt);

          
            if (mysqli_stmt_num_rows($stmt) == 0) {
                echo "<h3>No flights are available!</h3>";
            } else {
                echo "<form action=\"book_tickets2.php\" method=\"post\">";
                echo "<div class=\"flight-list-horizontal\">";
                
                while (mysqli_stmt_fetch($stmt)) {
                    echo "<div class=\"flight-item-horizontal\">";
                    echo "<p><strong>Flight No.:</strong> " . $flight_no . "</p>";
                    echo "<p><strong>Origin:</strong> " . $from_city . "</p>";
                    echo "<p><strong>Destination:</strong> " . $to_city . "</p>";
                    echo "<p><strong>Departure Date:</strong> " . $departure_date . "</p>";
                    echo "<p><strong>Departure Time:</strong> " . $departure_time . "</p>";
                    echo "<p><strong>Arrival Date:</strong> " . $arrival_date . "</p>";
                    echo "<p><strong>Arrival Time:</strong> " . $arrival_time . "</p>";
                    echo "<p><strong>Price:</strong> &#x20b9; " . $price . "</p>";
                    echo "<p><input type=\"radio\" name=\"select_flight\" value=\"" . $flight_no . "\"> Select</p>";
                    echo "</div>";
                }

                echo "</div><br>";
                echo "<input type=\"submit\" value=\"Select Flight\" name=\"Select\">";
                echo "</form>";
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        } else {
            echo "The following data fields were empty! <br>";
            foreach ($data_missing as $missing) {
                echo $missing . "<br>";
            }
        }
    }
?>
	<!-- Footer Section -->
     <div class="footer">
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
    </footer></div>
    </body>
</html>