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

$query = "SELECT * FROM payments ORDER BY payment_date DESC";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payments Admin</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f9f9f9;
            padding: 2rem;
        }
        h1 {
            color: #8e44ad;
            text-align: center;
            margin-bottom: 2rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 1rem;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 1.4rem;
        }
        th {
            background-color: #8e44ad;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .masked-card {
            font-family: monospace;
        }
    </style>
</head>
<body>
    <h1>Payments Records</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Booking ID</th>
                <th>Name on Card</th>
                <th>Card Number</th>
                <th>Payment Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?=htmlspecialchars($row['id'])?></td>
                <td><?=htmlspecialchars($row['booking_id'])?></td>
                <td><?=htmlspecialchars($row['name_on_card'])?></td>
                <td class="masked-card">**** **** **** <?=htmlspecialchars(substr($row['card_number'], -4))?></td>
                <td><?=htmlspecialchars($row['payment_date'])?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
<?php
mysqli_free_result($result);
mysqli_close($connection);
?>
