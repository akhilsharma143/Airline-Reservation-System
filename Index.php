<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIRWAYS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="Style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>


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



<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>  
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/bg4.jpg" class="d-block w-100" alt="Royal Airline Image 1">
            <div class="carousel-caption d-none d-md-block">
                <h5>Fly With Royal Airline</h5>
                <p>Experience the luxury of world-class service and comfort with Royal Airline.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/bg7.jpg" class="d-block w-100" alt="Royal Airline Image 2">
            <div class="carousel-caption d-none d-md-block">
                <h5>Discover Elegance in the Sky</h5>
                <p>Travel in style and enjoy a premium experience every time you fly with us.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/bg1.jpg" class="d-block w-100" alt="Royal Airline Image 3">
            <div class="carousel-caption d-none d-md-block">
                <h5>Royal Airline: Where Luxury Meets Adventure</h5>
                <p>Explore the world with unmatched comfort, safety, and class.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

        
      
<div class="topflights">
    <div class="container py-5">
        <div class="text-center mb-4" style="font-size: 50px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Popular Flights
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="#" class="text-decoration-none text-dark">
                        <img src="images/delhi.jpg" class="img-fluid card-img-top img-size" alt="London to Delhi">
                        <h4 class="mt-2 text-center">London to Delhi</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="Menu.html" class="text-decoration-none text-dark">
                        <img src="images/dubai.jpg" class="img-fluid card-img-top img-size" alt="Delhi to Dubai">
                        <h4 class="mt-2 text-center">Delhi to Dubai</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="Menu.html" class="text-decoration-none text-dark">
                        <img src="images/goa.jpg" class="img-fluid card-img-top img-size" alt="Delhi to Goa">
                        <h4 class="mt-2 text-center">Delhi to Goa</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="Menu.html" class="text-decoration-none text-dark">
                        <img src="images/indonesia.jpg" class="img-fluid card-img-top img-size" alt="Mumbai to Indonesia">
                        <h4 class="mt-2 text-center">Mumbai to Indonesia</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="Menu.html" class="text-decoration-none text-dark">
                        <img src="images/thailand.jpg" class="img-fluid card-img-top img-size" alt="Delhi to Thailand">
                        <h4 class="mt-2 text-center">Delhi to Thailand</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="Menu.html" class="text-decoration-none text-dark">
                        <img src="images/singapore.jpg" class="img-fluid card-img-top img-size" alt="Chandigarh to Singapore">
                        <h4 class="mt-2 text-center">Chandigarh to Singapore</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="About">
    <div class="image-container">
        <img src="images/form.jpg" alt="Background Image" class="img-fluid">
        <div class="overlay">
            <h2 class="text-center">About Us</h2>
        </div>
    </div>
</div>
<div id="about-us" class="py-5">
    <div class="container">
        <div class="row align-items-center mt-1">
            <div class="col-md-6">
                <img src="images/bg1.jpg" alt="About Us" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <h2 class="mb-4" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Our Story</h2>
                <p style="font-size: 18px;"> Welcome aboard Royal Airways, where your journey begins with unparalleled luxury, soaring service, and a regal experience in the skies.</p>
                </div>

            </div>
        </div>
    </div>
</div>
    





        <div class="about2" id="cell"data-aos="zoom-out">
    <p>"Welcome to Royal Airways, where the art of flying meets the essence of royalty. Immerse yourself in a world of sophistication, where every detail is crafted to ensure your journey is as exceptional as the destination."</p>
  <p>"At Royal Airways, our legacy soars high – a legacy built on a foundation of excellence, elegance, and a relentless pursuit of providing a distinguished flying experience for our esteemed passengers."<p>
    <p>"Step into a realm of unparalleled aviation with Royal Airways, where our wings unfold to carry you with grace, style, and the promise of a distinctive travel encounter."</p>
    <p>"Royal Airways invites you to elevate your travel expectations. Join us on a voyage where innovation, prestige, and a passion for perfection converge to redefine the very essence of air travel."</p>
    <p>"Our story at Royal Airways is one of majestic journeys and unwavering dedication. Experience the harmony of luxury and efficiency as we navigate the skies with a commitment to regal service and elevated travel experiences."</p>
    <p>"Embrace a new era of aviation with Royal Airways, where we marry tradition with innovation, creating an atmosphere where the spirit of royalty takes flight."</p>
    <p>"Step into a world of timeless elegance and unparalleled service. Royal Airways invites you to embark on a voyage where the essence of luxury and the thrill of discovery converge at 30,000 feet."</p>
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
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
      </script>


</body>
</html>
