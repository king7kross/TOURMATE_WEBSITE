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

$userEmail = $_SESSION['user']['email'] ?? null;
$userName = $_SESSION['user']['username'] ?? null;

if ($userEmail) {
    // Fetch the latest booking for the logged-in user by email
    $query = "SELECT * FROM book_form WHERE email = ? ORDER BY id DESC LIMIT 1";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
} elseif ($userName) {
    // Fallback: fetch by username if email not available
    $query = "SELECT * FROM book_form WHERE name = ? ORDER BY id DESC LIMIT 1";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $userName);
} else {
    // No user identifier found, fetch latest booking (not recommended)
    $query = "SELECT * FROM book_form ORDER BY id DESC LIMIT 1";
    $stmt = mysqli_prepare($connection, $query);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$booking = mysqli_fetch_assoc($result);

if (!$booking) {
    $booking = null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove_booking']) && $booking) {
        $deleteQuery = "DELETE FROM book_form WHERE id = ?";
        $deleteStmt = mysqli_prepare($connection, $deleteQuery);
        mysqli_stmt_bind_param($deleteStmt, "i", $booking['id']);
        mysqli_stmt_execute($deleteStmt);
        mysqli_stmt_close($deleteStmt);
        header("Location: home.php");
        exit;
    } elseif (isset($_POST['proceed_payment'])) {
        // Redirect to payment gateway page
        header("Location: payment_gateway.php");
        exit;
    }
}

mysqli_stmt_close($stmt);
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        .checkout-container {
            max-width: 600px;
            margin: 3rem auto;
            padding: 2rem;
            border: 1px solid #8e44ad;
            border-radius: 10px;
            background: #f9f9f9;
            font-family: 'Poppins', sans-serif;
        }
        h2 {
            color: #8e44ad;
            text-align: center;
            margin-bottom: 2rem;
        }
        .booking-details {
            margin-bottom: 2rem;
        }
        .booking-details p {
            font-size: 1.6rem;
            margin: 0.5rem 0;
        }
        .btn-group {
            display: flex;
            justify-content: space-between;
        }
        .btn {
            background-color: #8e44ad;
            color: white;
            border: none;
            padding: 1rem 2rem;
            font-size: 1.6rem;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #732d91;
        }
        .no-booking {
            text-align: center;
            font-size: 1.8rem;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="checkout-container">
        <h2>Checkout</h2>
        <?php if ($booking): ?>
            <div class="booking-details">
                <p><strong>Name:</strong> <?=htmlspecialchars($booking['name'])?></p>
                <p><strong>Email:</strong> <?=htmlspecialchars($booking['email'])?></p>
                <p><strong>Phone:</strong> <?=htmlspecialchars($booking['phone'])?></p>
                <p><strong>Address:</strong> <?=htmlspecialchars($booking['address'])?></p>
                <p><strong>Destination:</strong> <?=htmlspecialchars($booking['location'])?></p>
                <p><strong>Guests:</strong> <?=htmlspecialchars($booking['guests'])?></p>
                <p><strong>Arrival Date:</strong> <?=htmlspecialchars($booking['arrivals'])?></p>
                <p><strong>Departure Date:</strong> <?=htmlspecialchars($booking['departure'])?></p>
            </div>
            <form method="post" class="btn-group">
                <button type="submit" name="remove_booking" class="btn" onclick="return confirm('Are you sure you want to remove your booking?');">Remove Booking</button>
                <button type="submit" name="proceed_payment" class="btn">Proceed to Payment</button>
            </form>
        <?php else: ?>
            <p class="no-booking">No booking details found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
