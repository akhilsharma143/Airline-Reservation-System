<?php
	session_start();
	include('connection.php');
?>
<html>
	<head>
		<title>
			Enter Payment Details
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
		<form action="payment_details_form_handler.php" method="post">
			<h2>ENTER THE PAYMENT DETAILS</h2>
			<h3 style="margin-left: 30px"><u>Payment Summary</u></h3>
			<?php
				$flight_no=$_SESSION['flight_no'];
				$journey_date=$_SESSION['journey_date'];
				$no_of_pass=$_SESSION['no_of_pass'];
				$payment_id=rand(100000000,999999999);
				$pnr=$_SESSION['pnr'];
				$_SESSION['payment_id']=$payment_id;
				$payment_date=date('Y-m-d'); 
				$_SESSION['payment_date']=$payment_date;

				if($_SESSION['class']=='economy')
				{	
					$query="SELECT price_economy FROM flights where flight_no=? and departure_date=?";
					$stmt=mysqli_prepare($conn,$query);
					mysqli_stmt_bind_param($stmt,"ss",$flight_no,$journey_date);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt,$ticket_price);
					mysqli_stmt_fetch($stmt);
				}
				else if($_SESSION['class']=='business')
				{
					$query="SELECT price_business FROM flights where flight_no=? and departure_date=?";
					$stmt=mysqli_prepare($conn,$query);
					mysqli_stmt_bind_param($stmt,"ss",$flight_no,$journey_date);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt,$ticket_price);
					mysqli_stmt_fetch($stmt);
				}
				mysqli_stmt_close($stmt);
				mysqli_close($conn);
				$total_ticket_price=$no_of_pass*$ticket_price;
				$total_discount=0;
				$total_amount=$total_ticket_price+$total_discount;
				$_SESSION['total_amount']=$total_amount;

				echo "<table cellpadding=\"5\"	style='margin-left: 50px'>";
				echo "<tr>";
				echo "<td class=\"fix_table\">Base Fare, Fuel and Transaction Charges (Fees & Taxes included):</td>";
				echo "<td class=\"fix_table\">&#x20b9; ".$total_ticket_price."</td>";
				echo "</tr>";

			

				echo "<tr>";
				echo "<td class=\"fix_table\">Discount:</td>";
				echo "<td class=\"fix_table\">&#x20b9; ".$total_discount."</td>";
				echo "</tr>";

				echo "</table>";

				echo "<hr style='margin-right:900px; margin-left: 50px'>";
				echo "<table cellpadding=\"5\" style='margin-left: 50px'>";
				echo "<tr>";
				echo "<td class=\"fix_table\"><strong>Total:</strong></td>";
				echo "<td class=\"fix_table\">&#x20b9; ".$total_amount."</td>";
				echo "</tr>";
				echo "</table>";
				echo "<hr style='margin-right:900px; margin-left: 50px'>";
				echo "<br>";
				echo "<p style=\"margin-left:50px\">Your Payment/Transaction ID is <strong>".$payment_id.".</strong> Please note it down for future reference.</p>";
				echo "<br>";
			?>
			<table cellpadding="5" style='margin-left: 50px'>
				<tr>
					<td class="fix_table"><strong>Enter the Payment Mode:-</strong></td>
				</tr>
				<tr>
					<td class="fix_table"><i class="fa fa-credit-card" aria-hidden="true"></i> Credit Card <input type="radio" name="payment_mode" value="credit card" checked></td>
					<td class="fix_table"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Debit Card <input type="radio" name="payment_mode" value="debit card"></td>
					<td class="fix_table"><i class="fa fa-desktop" aria-hidden="true"></i> Net Banking <input type="radio" name="payment_mode" value="net banking"></td>
				</tr>
			</table>
			<br>
			<input type="submit" value="Pay Now" name="Pay_Now">
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