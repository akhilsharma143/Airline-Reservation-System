<?php
    session_start();
    include ('connection.php');
?>

<html>
    <head>
        <title>Add Ticket Details</title>
    </head>
    <body>
        <?php
            $i = 1;
            if(isset($_POST['Submit']))
            {
                $pnr = rand(1000000,9999999);
                $date_of_res = date("Y-m-d");
                $flight_no = $_SESSION['flight_no'];
                $journey_date = $_SESSION['journey_date'];
                $class = $_SESSION['class'];
                $booking_status = "CONFIRMED";
                $no_of_pass = $_SESSION['no_of_pass'];
                $_SESSION['pnr'] = $pnr;

                // $payment_id = isset($_SESSION['payment_id']) ? $_SESSION['payment_id'] : 0;
                // $payment_id =$_SESSION['payment_id'];
                $customer_id=$_SESSION['customer_id'];
                // $payment_id = NULL;
                // $customer_id = $_SESSION['login_user'];

                // Debugging output
                // echo "Flight No: $flight_no, Journey Date: $journey_date<br>";

                if($_SESSION['class'] == 'economy')
                {   
                    $query = "SELECT price_economy FROM flights WHERE flight_no=? AND departure_date=?";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "ss", $flight_no, $journey_date);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $ticket_price);
                    mysqli_stmt_fetch($stmt);
                }
                else if($_SESSION['class'] == 'business')
                {
                    $query = "SELECT price_business FROM flights WHERE flight_no=? AND departure_date=?";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "ss", $flight_no, $journey_date);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $ticket_price);
                    mysqli_stmt_fetch($stmt);
                }
                mysqli_stmt_close($stmt);
                $ff_mileage = $ticket_price / 10;

                $query = "INSERT INTO ticket_details (pnr, date_of_reservation, flight_no, journey_date, class, booking_status, no_of_passengers, customer_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "ssssssii", $pnr, $date_of_res, $flight_no, $journey_date, $class, $booking_status, $no_of_pass,$customer_id);

                mysqli_stmt_execute($stmt);
                $affected_rows = mysqli_stmt_affected_rows($stmt);

                if ($affected_rows == 1) {
                    echo "Successfully Submitted<br>";
                    header("location: payment_details.php");
                } else {
                    echo "Submit Error: " . mysqli_error($conn);
                }
            }
        ?>
    </body>
</html>