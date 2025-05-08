<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$connection = mysqli_connect('localhost', 'root', '', 'book_db');
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

$bookingId = $_SESSION['booking_id'] ?? null;
$booking = null;
$payment = null;

if ($bookingId) {
    // Fetch payment details by booking ID
    $paymentQuery = "SELECT * FROM payments WHERE booking_id = ?";
    $paymentStmt = mysqli_prepare($connection, $paymentQuery);
    mysqli_stmt_bind_param($paymentStmt, "s", $bookingId);
    mysqli_stmt_execute($paymentStmt);
    $paymentResult = mysqli_stmt_get_result($paymentStmt);
    $payment = mysqli_fetch_assoc($paymentResult);
    mysqli_stmt_close($paymentStmt);

    // Fetch booking details by booking ID
    $bookingQuery = "SELECT * FROM book_form WHERE id = (SELECT id FROM book_form WHERE email = ? ORDER BY id DESC LIMIT 1)";
    $bookingStmt = mysqli_prepare($connection, $bookingQuery);
    $userEmail = $_SESSION['user']['email'] ?? null;
    mysqli_stmt_bind_param($bookingStmt, "s", $userEmail);
    mysqli_stmt_execute($bookingStmt);
    $bookingResult = mysqli_stmt_get_result($bookingStmt);
    $booking = mysqli_fetch_assoc($bookingResult);
    mysqli_stmt_close($bookingStmt);
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Confirmation</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #8e44ad, #6a1b9a);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 2rem;
        }
        .confirmation-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 3rem 4rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 0 0 10px #fff;
        }
        p {
            font-size: 1.8rem;
            margin-bottom: 2rem;
        }
        .booking-id {
            font-size: 2.4rem;
            font-weight: 700;
            letter-spacing: 0.3rem;
            background: linear-gradient(90deg, #ff6a00, #ee0979);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 2rem;
        }
        .booking-details, .payment-details {
            text-align: left;
            background: rgba(255, 255, 255, 0.15);
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            font-size: 1.6rem;
            line-height: 1.5;
        }
        .booking-details p, .payment-details p {
            margin: 0.3rem 0;
        }
        a.btn {
            display: inline-block;
            background-color: #fff;
            color: #8e44ad;
            padding: 1rem 2rem;
            font-size: 1.6rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.4);
            transition: background-color 0.3s ease;
        }
        a.btn:hover {
            background-color: #f0e6ff;
        }
    </style>
</head>
<body>
    <div class="confirmation-container" role="main" aria-live="polite">
        <h1>Congratulations!</h1>
        <p>Your booking is confirmed.</p>
        <?php if ($payment): ?>
            <div class="booking-id" aria-label="Booking ID">Booking ID - <?=htmlspecialchars($payment['booking_id'])?></div>
            <div class="payment-details" aria-label="Payment Details">
                <p><strong>Name on Card:</strong> <?=htmlspecialchars($payment['name_on_card'])?></p>
                <p><strong>Card Number:</strong> **** **** **** <?=htmlspecialchars(substr($payment['card_number'], -4))?></p>
            </div>
        <?php endif; ?>
        <?php if ($booking): ?>
            <div class="booking-details" aria-label="Booking Details">
                <p><strong>Name:</strong> <?=htmlspecialchars($booking['name'])?></p>
                <p><strong>Email:</strong> <?=htmlspecialchars($booking['email'])?></p>
                <p><strong>Phone:</strong> <?=htmlspecialchars($booking['phone'])?></p>
                <p><strong>Address:</strong> <?=htmlspecialchars($booking['address'])?></p>
                <p><strong>Destination:</strong> <?=htmlspecialchars($booking['location'])?></p>
                <p><strong>Guests:</strong> <?=htmlspecialchars($booking['guests'])?></p>
                <p><strong>Arrival Date:</strong> <?=htmlspecialchars($booking['arrivals'])?></p>
                <p><strong>Departure Date:</strong> <?=htmlspecialchars($booking['departure'])?></p>
            </div>
        <?php else: ?>
            <p>No booking details found.</p>
        <?php endif; ?>
        <a href="home.php" class="btn" role="button">Back to Home</a>
    </div>
</body>
</html>
