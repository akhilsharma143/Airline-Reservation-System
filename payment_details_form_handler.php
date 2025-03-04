<?php
	session_start();
	include('connection.php');
?>
<html>
	<head>
		<title>Submit Payment Details</title>
	</head>
	<body>
		<?php
			if(isset($_POST['Pay_Now']))
			{
				$no_of_pass=$_SESSION['no_of_pass'];
				$flight_no=$_SESSION['flight_no'];
				$journey_date=$_SESSION['journey_date'];
				$class=$_SESSION['class'];
				$pnr=$_SESSION['pnr'];
				$payment_id=$_SESSION['payment_id'];
				$total_amount=$_SESSION['total_amount'];
				$payment_date=$_SESSION['payment_date'];
				$payment_mode=$_POST['payment_mode'];				

				$affected_rows_1 = 0; // Initialize affected rows variable

				if($class=='economy')
				{
					$query="UPDATE flights SET seats_economy=seats_economy-? WHERE flight_no=? AND departure_date=?";
					$stmt=mysqli_prepare($conn,$query);
					mysqli_stmt_bind_param($stmt,"iss",$no_of_pass,$flight_no,$journey_date);
					mysqli_stmt_execute($stmt);
					$affected_rows_1=mysqli_stmt_affected_rows($stmt);
					echo $affected_rows_1.'<br>';
					mysqli_stmt_close($stmt);
				}
				else if($class=='business')
				{
					$query="UPDATE flights SET seats_business=seats_business-? WHERE flight_no=? AND departure_date=?";
					$stmt=mysqli_prepare($conn,$query);
					mysqli_stmt_bind_param($stmt,"iss",$no_of_pass,$flight_no,$journey_date);
					mysqli_stmt_execute($stmt);
					$affected_rows_1=mysqli_stmt_affected_rows($stmt);
					echo $affected_rows_1.'<br>';
					mysqli_stmt_close($stmt);
				}

				if($affected_rows_1==1)
				{
					echo "Successfully Updated Seats<br>";

					$query="INSERT INTO payment_details (payment_id,pnr,payment_date,payment_amount,payment_mode) VALUES (?,?,?,?,?)";
					$stmt=mysqli_prepare($conn,$query);
					mysqli_stmt_bind_param($stmt,"sssis",$payment_id,$pnr,$payment_date,$total_amount,$payment_mode);
					mysqli_stmt_execute($stmt);
					$affected_rows_2=mysqli_stmt_affected_rows($stmt);
					echo $affected_rows_2.'<br>';
					mysqli_stmt_close($stmt);
					if($affected_rows_2==1)
					{
						echo "Successfully Updated Payment Details<br>";
						header('location:ticket_success.php');
					}
					else
					{
						echo "Submit Error: " . mysqli_error($conn); // Fix error by providing the connection parameter
					}
				}
				else
				{
					echo "Submit Error: " . mysqli_error($conn); // Fix error by providing the connection parameter
				}
				mysqli_close($conn);
			}
			else
			{
				echo "Payment request not received";
			}
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
