<?php
session_start();

$errors = [];
$success = '';

$connection = mysqli_connect('localhost', 'root', '', 'book_db');
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (!$username) {
        $errors[] = "Username is required.";
    }
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }
    if (!$password) {
        $errors[] = "Password is required.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        // Check if email already exists in database
        $stmt = mysqli_prepare($connection, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $errors[] = "Email is already registered.";
        }
        mysqli_stmt_close($stmt);

        if (empty($errors)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insertStmt = mysqli_prepare($connection, "INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($insertStmt, "sss", $username, $email, $hashedPassword);
            if (mysqli_stmt_execute($insertStmt)) {
                $success = "Registration successful. You can now <a href='login.php'>login</a>.";
            } else {
                $errors[] = "Failed to register user. Please try again.";
            }
            mysqli_stmt_close($insertStmt);
        }
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<section class="header">
  <a href="home.php" class="logo">travel</a>
  <nav class="navbar">
   <a href="home.php">home</a>
   <a href="about.php">about</a>
   <a href="package.php">package</a>
   <a href="book.php">book</a>
   <a href="login.php">login</a>
   <a href="register.php">register</a>
  </nav>
  <div id="menu-btn" class="fas fa-bars"></div>
</section>

<div class="heading" style="background:url(1.jpg) no-repeat">
    <h1>Register</h1>
</div>

<section class="booking">
    <h1 class="heading-title">Create an Account</h1>
<?php if ($errors): ?>
    <div style="color: red; margin-bottom: 1.5rem; font-size: 1.6rem; font-weight: 600;">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?=htmlspecialchars($error)?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<?php if ($success): ?>
    <div style="color: green; margin-bottom: 1.5rem; font-size: 1.6rem; font-weight: 600;"><?= $success ?></div>
<?php endif; ?>
    <form action="register.php" method="post" class="book-form">
        <div class="flex">
            <div class="inputBox">
                <span>Username :</span>
                <input type="text" name="username" placeholder="Enter your username" required />
            </div>
            <div class="inputBox">
                <span>Email :</span>
                <input type="email" name="email" placeholder="Enter your email" required />
            </div>
            <div class="inputBox">
                <span>Password :</span>
                <input type="password" name="password" placeholder="Enter your password" required />
            </div>
            <div class="inputBox">
                <span>Confirm Password :</span>
                <input type="password" name="confirm_password" placeholder="Confirm your password" required />
            </div>
        </div>
        <input type="submit" value="Register" class="btn" />
    </form>
</section>

</body>
</html>
