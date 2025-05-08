<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$connection = mysqli_connect('localhost','root','','book_db');

if(isset($_POST['send'])){
    $name = $_POST['name'];
    // Override email with logged-in user's email from session for consistency
    $email = $_SESSION['user']['email'] ?? $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $location = $_POST['location'];
    $guests = $_POST['guests'];
    $arrivals = $_POST['arrivals'];
    $departure = $_POST['departure'];
    
    $request = "INSERT INTO book_form(name, email, phone, address, location, guests, arrivals, departure) VALUES('$name','$email','$phone','$address','$location','$guests','$arrivals','$departure')";

    $result = mysqli_query($connection, $request);

    if ($result) {
        $_SESSION['booking_confirmed'] = true;
        header('Location: checkout.php');
        exit;
    } else {
        echo 'Booking failed. Please try again.';
    }

}else{
    echo 'something went wrong try again';
}
?>
