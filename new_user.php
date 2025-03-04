<?php
include('connection.php');

    if(isset($_POST['Submit']))
    {
        $data_missing=array();
        if(empty($_POST['username']))
        {
            $data_missing[]='User Name';
        }
        else
        {
            $user_name=trim($_POST['username']);
        }
        if(empty($_POST['password']))
        {
            $data_missing[]='Password';
        }
        else
        {
            $password=$_POST['password'];
        }
        if(empty($_POST['email']))
        {
            $data_missing[]='Email ID';
        }
        else
        {
            $email_id=trim($_POST['email']);
        }

        if(empty($_POST['name']))
        {
            $data_missing[]='Name';
        }
        else
        {
            $name=$_POST['name'];
        }
        if(empty($_POST['phone_no']))
        {
            $data_missing[]='Phone No.';
        }
        else
        {
            $phone_no=trim($_POST['phone_no']);
        }
        if(empty($_POST['address']))
        {
            $data_missing[]='Address';
        }
        else
        {
            $address=$_POST['address'];
        }

        if(empty($data_missing))
        {

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query="INSERT INTO customer (username ,password,name,email,phone_no,address) VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($query);
            
                mysqli_stmt_bind_param($stmt,"ssssis",$user_name,$hashed_password,$name,$email_id,$phone_no,$address);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                mysqli_stmt_execute($stmt);
                
                $affected_rows=mysqli_stmt_affected_rows($stmt);
                if($affected_rows==1)
                {
                    echo "<br><br><br><br><b>New user successfully registered! Login into your account to book tickets.</b>";
                }
                else
                {
                    echo "Submit Error" . mysqli_stmt_error($stmt); 
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                
            }
        else
        {
            echo "The following data fields were empty! <br>";
            foreach($data_missing as $missing)
            {
                echo $missing ."<br>";
            }
        }
    }
?>

        <html>
	<head>
		<title>
			Create New User Account
		</title>
		<style>

	body{
        background-image: url("images/ar2.jpg");
            background-size: cover; 
            background-repeat: no-repeat; 
            background-attachment: fixed; 
    }

	form{
    margin:5px auto 20px auto;
    border-radius: 15px;
    box-shadow: 0 0 8px 2px black;
    padding: 10px 80px 15px;
    font-size: large;
    width:110%;
    background-color: rgba(255, 255, 255, 0.3);
    }

	.form-group{
    color:black;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 20px;
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


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <form action="new_user.php" method="POST">
                <h2 class="text-center"><i class="fa fa-user-plus" aria-hidden="true"></i> CREATE NEW USER ACCOUNT</h2>
                <div class="form-group">
                    <label for="username">Enter a valid username:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Enter your password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Enter your email ID:</label>
                    <input type="text" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="name">Enter your name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone_no">Enter your phone no.:</label>
                    <input type="text" id="phone_no" name="phone_no" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Enter your address:</label>
                    <input type="text" id="address" name="address" class="form-control" required>
                </div>
                <div class="text-center">
                    <button type="submit" name="Submit"class="btn btn-primary">Submit</button>
                    <a href="Index.php" class="btn btn-secondary ml-2">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
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