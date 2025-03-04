<?php
    session_start();
    include('connection.php');
?>
<html>
<head>
    <title>Cancel Booked Tickets</title>
</head>
<body>
<?php
    if(isset($_POST['Cancel_Ticket'])) {
        $data_missing = array();
        if(empty($_POST['pnr'])) {
            $data_missing[] = 'PNR';
        } else {
            $pnr = trim($_POST['pnr']);
        }

        if(empty($data_missing)) {
            $todays_date = date('Y-m-d'); 
            $customer_id = $_SESSION['login_user'];

            $query = "SELECT COUNT(*) FROM ticket_details WHERE pnr=? AND journey_date>=?";
            $stmt = mysqli_prepare($conn, $query);
            if($stmt) {
                mysqli_stmt_bind_param($stmt, "ss", $pnr, $todays_date);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $cnt);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);

                if($cnt != 1) {
                    mysqli_close($conn);
                    header("location: cancel_booked_tickets.php?msg=failed");
                    exit(); // exit after header to prevent further execution
                }

                $query = "UPDATE ticket_details SET booking_status='CANCELED' WHERE pnr=? AND customer_id=?";
                $stmt = mysqli_prepare($conn, $query);
                if($stmt) {
                    mysqli_stmt_bind_param($stmt, "ss", $pnr, $customer_id);
                    mysqli_stmt_execute($stmt);
                    $affected_rows = mysqli_stmt_affected_rows($stmt);
                    mysqli_stmt_close($stmt);

                    if($affected_rows == 1) {
                        $query = "SELECT t.flight_no, t.journey_date, t.no_of_passengers, t.class, 0.85 * p.payment_amount AS refund_amount 
                                  FROM ticket_details t 
                                  INNER JOIN payment_details p ON t.pnr = p.pnr 
                                  WHERE t.pnr=?";
                        $stmt = mysqli_prepare($conn, $query);
                        if($stmt) {
                            mysqli_stmt_bind_param($stmt, "s", $pnr);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $flight_no, $journey_date, $no_of_pass, $class, $refund_amount);
                            mysqli_stmt_fetch($stmt);
                            mysqli_stmt_close($stmt);

                            $_SESSION['refund_amount'] = $refund_amount;

                            if($class == 'economy') {
                                $query = "UPDATE flights SET seats_economy = seats_economy + ? WHERE flight_no = ? AND departure_date = ?";
                            } elseif($class == 'business') {
                                $query = "UPDATE flights SET seats_business = seats_business + ? WHERE flight_no = ? AND departure_date = ?";
                            }

                            $stmt = mysqli_prepare($conn, $query);
                            if($stmt) {
                                mysqli_stmt_bind_param($stmt, "iss", $no_of_pass, $flight_no, $journey_date);
                                mysqli_stmt_execute($stmt);
                                $affected_rows_1 = mysqli_stmt_affected_rows($stmt);
                                mysqli_stmt_close($stmt);

                                if($affected_rows_1 == 1) {
                                    header("location: cancel_booked_tickets_success.php");
                                    exit(); // exit after header to prevent further execution
                                } else {
                                    echo "Submit Error";
                                }
                            } else {
                                echo "Submit Error";
                            }
                        } else {
                            echo "Submit Error";
                        }
                    } else {
                        echo "Submit Error";
                        header("location: cancel_booked_tickets.php?msg=failed");
                    }
                } else {
                    echo "Submit Error";
                }
            } else {
                echo "Submit Error";
            }

            mysqli_close($conn);
        } else {
            echo "The following data fields were empty! <br>";
            foreach($data_missing as $missing) {
                echo $missing . "<br>";
            }
        }
    } else {
        echo "Cancel request not received";
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
                <p>Phone: 8219366869</p>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white text-center py-2">
        <p>&copy; 2023 Royal Airways. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
