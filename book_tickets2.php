<?php
	session_start();
?>
<html>
	<head>
		<title>
			Enter Travel/Ticket Details
		</title>
		<style>
            body {
            background-image: url("images/fly.jpg");
            background-size: cover; 
            background-repeat: no-repeat; 
            background-attachment: fixed; 
            }
		form {
            margin: 20px auto;
            padding: 5px;
            border-radius: 15px;
            box-shadow: 4px 5px 8px 2px black;
            background-color: rgba(255, 255, 255, 0.4);
            max-width: 600px;
        }
		label {
        
	padding: 10px;
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
	<?php
        $no_of_pass = $_SESSION['no_of_pass'];
        $class = $_SESSION['class'];
        $count = $_SESSION['count'];
        $flight_no = $_POST['select_flight'];
        $_SESSION['flight_no'] = $flight_no;

        echo "<h2><br><br>ADD PASSENGERS DETAILS</h2>";
        echo "<form action=\"add_ticket_details_form_handler.php\" method=\"post\">";
        
        while ($count <= $no_of_pass) {
            echo "<div>";
            echo "<p><strong>PASSENGER " . $count . "</strong></p>";
            
            echo "<label for=\"pass_name\"> Name</label>";
            echo "<input type=\"text\" name=\"pass_name[]\" required>";

            echo "<label for=\"pass_age\"> Age</label>";
            echo "<input type=\"number\" name=\"pass_age[]\" required>";

            echo "<label for=\"pass_gender\">Gender</label>";
            echo "<select name=\"pass_gender[]\">";
            echo "<option value=\"male\">Male</option>";
            echo "<option value=\"female\">Female</option>";
            echo "<option value=\"other\">Other</option>";
            echo "</select>";
           echo "<br>";
			echo "<label for=\"pass_no\"> Mobile No</label>";
            echo "<input type=\"text\" name=\"pass_no[]\" required>";

			echo "<label for=\"pass_email\"> Email</label>";
            echo "<input type=\"text\" name=\"pass_email[]\" required>";
            
            echo "</div>";
            $count = $count + 1;
        }

        echo "<input type=\"submit\" value=\"Submit Travel/Ticket Details\" name=\"Submit\">";
        echo "</form>";
    ?>
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