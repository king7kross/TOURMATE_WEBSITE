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

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic validation
    $cardNumber = trim($_POST['card_number'] ?? '');
    $expiry = trim($_POST['expiry'] ?? '');
    $cvv = trim($_POST['cvv'] ?? '');
    $nameOnCard = trim($_POST['name_on_card'] ?? '');

    if (empty($cardNumber) || !preg_match('/^\d{16}$/', $cardNumber)) {
        $errors[] = "Please enter a valid 16-digit card number.";
    }
    if (empty($expiry) || !preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $expiry)) {
        $errors[] = "Please enter a valid expiry date in MM/YY format.";
    }
    if (empty($cvv) || !preg_match('/^\d{3}$/', $cvv)) {
        $errors[] = "Please enter a valid 3-digit CVV.";
    }
    if (empty($nameOnCard)) {
        $errors[] = "Please enter the name on the card.";
    }

    if (empty($errors)) {
        // Fetch latest booking for user
        $userEmail = $_SESSION['user']['email'] ?? null;
        $userName = $_SESSION['user']['username'] ?? null;

        if ($userEmail) {
            $query = "SELECT * FROM book_form WHERE email = ? ORDER BY id DESC LIMIT 1";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "s", $userEmail);
        } elseif ($userName) {
            $query = "SELECT * FROM book_form WHERE name = ? ORDER BY id DESC LIMIT 1";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "s", $userName);
        } else {
            $query = "SELECT * FROM book_form ORDER BY id DESC LIMIT 1";
            $stmt = mysqli_prepare($connection, $query);
        }

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $booking = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if (!$booking) {
            $errors[] = "No booking found for payment.";
        } else {
            // Generate booking ID
            $bookingId = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);

            // Insert payment record
            $insertQuery = "INSERT INTO payments (booking_id, card_number, name_on_card) VALUES (?, ?, ?)";
            $insertStmt = mysqli_prepare($connection, $insertQuery);
            mysqli_stmt_bind_param($insertStmt, "sss", $bookingId, $cardNumber, $nameOnCard);
            $success = mysqli_stmt_execute($insertStmt);
            mysqli_stmt_close($insertStmt);

            if ($success) {
                // Store booking ID in session for payment.php
                $_SESSION['booking_id'] = $bookingId;
                header('Location: payment.php');
                exit;
            } else {
                $errors[] = "Failed to record payment. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Gateway</title>
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
        .payment-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 3rem 4rem;
            border-radius: 15px;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        }
        h1 {
            text-align: center;
            margin-bottom: 2rem;
            text-shadow: 0 0 10px #fff;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        input[type="text"],
        input[type="tel"] {
            padding: 0.8rem;
            margin-bottom: 1.5rem;
            border-radius: 5px;
            border: none;
            font-size: 1.4rem;
        }
        .error {
            background-color: #ff4d4d;
            color: white;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            font-size: 1.4rem;
        }
        button {
            background-color: #8e44ad;
            color: white;
            border: none;
            padding: 1rem;
            font-size: 1.6rem;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 600;
        }
        button:hover {
            background-color: #732d91;
        }
    </style>
</head>
<body>
    <div class="payment-container" role="main" aria-live="polite">
        <h1>Payment Gateway</h1>
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="error" role="alert"><?=htmlspecialchars($error)?></div>
            <?php endforeach; ?>
        <?php endif; ?>
        <form method="post" novalidate>
            <label for="card_number">Card Number</label>
            <input type="tel" id="card_number" name="card_number" maxlength="16" pattern="[0-9]{16}" placeholder="1234 5678 9012 3456" required value="<?=htmlspecialchars($_POST['card_number'] ?? '')?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
            
            <label for="expiry">Expiry Date (MM/YY)</label>
            <input type="text" id="expiry" name="expiry" pattern="(0[1-9]|1[0-2])\/\d{2}" placeholder="MM/YY" required value="<?=htmlspecialchars($_POST['expiry'] ?? '')?>" oninput="formatExpiryDate(this)" maxlength="5" />
            
            <label for="cvv">CVV</label>
            <input type="tel" id="cvv" name="cvv" maxlength="3" pattern="[0-9]{3}" placeholder="123" required value="<?=htmlspecialchars($_POST['cvv'] ?? '')?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
            
            <label for="name_on_card">Name on Card</label>
            <input type="text" id="name_on_card" name="name_on_card" placeholder="John Doe" required value="<?=htmlspecialchars($_POST['name_on_card'] ?? '')?>" />
            
            <button type="submit">Pay Now</button>
        </form>
    </div>
    <script>
        function formatExpiryDate(input) {
            // Remove all non-digit and non-slash characters
            let value = input.value.replace(/[^0-9\/]/g, '');
            // Add slash after 2 digits if not present
            if (value.length === 2 && !value.includes('/')) {
                value = value + '/';
            }
            // Limit length to 5 characters (MM/YY)
            if (value.length > 5) {
                value = value.slice(0, 5);
            }
            input.value = value;
        }
    </script>
</body>
</html>
