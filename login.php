<?php
session_start();
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['AdminLogin'])) {
        
        $formSubmitted = true;
        $username = $conn->real_escape_string(trim($_POST['username']));

        $password = $conn->real_escape_string($_POST['password']);

        $sql1 = "SELECT * FROM admin WHERE username = ?";
        $sqlemail = "SELECT * FROM admin WHERE email = ?";
        
        $stmtemail = $conn->prepare($sqlemail);
        $stmtemail->bind_param("s", $username);
        $stmtemail->execute();
        $resemail = $stmtemail->get_result();

        $stmt = $conn->prepare($sql1);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0 || $resemail->num_rows > 0) {
            ($res->num_rows > 0) ? $row = $res->fetch_assoc() : $row = $resemail->fetch_assoc();
            $hashedpassword = $row['password'];
            // echo "db pass: $hashedpassword";
            // echo "<br>";
            // echo "my enter : ". password_hash($password,PASSWORD_DEFAULT);
            // die("<br>here");
            if (password_verify($password,$hashedpassword)) {
                $_SESSION['admin_id'] = $row['admin_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
               
                header("Location: admin_homepage.php"); 
                exit();
            } else {
                $login_error = "Invalid password. Please try again.";
            }
        } else {
            $login_error = "Invalid username or email. Please try again.";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } elseif (isset($_POST['CustomerLogin'])) {
     
        $formSubmitted = true;
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);

        $query = "SELECT * FROM customer WHERE username = ?";
        $stmt = $conn->prepare($query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Verify password
            if (password_verify($password, $row['password'])) {
  
                $_SESSION['customer_id'] = $row['customer_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['login_user']=$user_name;
							echo $_SESSION['login_user']." is logged in";
                header("Location: customer_homepage.php"); 
                exit();
            } else {
                $login_error = "Invalid password. Please try again.";
            }
        } else {
            $login_error = "Invalid username. Please try again.";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Login</title>
    <style>
        body {
            background-image: url("images/fly2.jpg");
            background-size: cover; 
            background-repeat: no-repeat; 
            background-attachment: fixed; 
        }

        .float_form {
            margin:90px auto 20px auto;
            max-width: 500px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 8px;
            padding: 20px;
			box-shadow: 2px 5px 8px 0.2px black;
        }

        legend {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        footer {
    position: absolute;
    bottom: 0;
    width: 100%;
}
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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

<!-- Login Form -->
<form class="float_form" action="login.php" method="POST">
    
        <legend>Login Details:</legend>
        <label for="username"><strong>Username:</strong></label>
        <input type="text" name="username" placeholder="Enter your username" required>

        <label for="password"><strong>Password:</strong></label>
        <input type="password" name="password" placeholder="Enter your password" required>

    <?php
    if (isset($login_error)) {
        echo "<div class='error-message'>$login_error</div>";
    }
    ?>
    
 <input type="submit" name="AdminLogin" value="Admin Login" class="btn btn-primary">
    <input type="submit" name="CustomerLogin" value="Customer Login" class="btn btn-primary">

    <div style="text-align: center; margin-top: 10px;">
    <a href="new_user.php" style="text-decoration: none; color: #030337;">
        <i class="fa fa-user-plus" ></i> Create New User Account
    </a><br>
    <a href="new_admin.php" style="text-decoration: none; color: #030337; margin-top: 10px;">
        <i class="fa fa-user-plus" aria-hidden="true"></i> Create New Admin Account
    </a>
</div>
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
