<?php
session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }
    if (!$password) {
        $errors[] = "Password is required.";
    }

if (empty($errors)) {
    $connection = mysqli_connect('localhost', 'root', '', 'book_db');
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $stmt = mysqli_prepare($connection, "SELECT username, email, password FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $usernameDb, $emailDb, $hashedPasswordDb);
    $userFound = false;
    if (mysqli_stmt_fetch($stmt)) {
        $userFound = true;
    }
    mysqli_stmt_close($stmt);

    if ($userFound && password_verify($password, $hashedPasswordDb)) {
        $_SESSION['user'] = [
            'username' => $usernameDb,
            'email' => $emailDb
        ];
        mysqli_close($connection);
        header('Location: home.php');
        exit;
    } else {
        $errors[] = "Invalid email or password.";
    }
    mysqli_close($connection);
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
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
    <h1>Login</h1>
</div>

<section class="booking">
    <h1 class="heading-title">Login to Your Account</h1>
<?php if ($errors): ?>
    <div style="color: red; margin-bottom: 1.5rem; font-size: 1.6rem; font-weight: 600;">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?=htmlspecialchars($error)?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
    <form action="login.php" method="post" class="book-form">
        <div class="flex">
            <div class="inputBox">
                <span>Email :</span>
                <input type="email" name="email" placeholder="Enter your email" required />
            </div>
            <div class="inputBox">
                <span>Password :</span>
                <input type="password" name="password" placeholder="Enter your password" required />
            </div>
        </div>
        <input type="submit" value="Login" class="btn" />
    </form>
</section>

</body>
</html>
