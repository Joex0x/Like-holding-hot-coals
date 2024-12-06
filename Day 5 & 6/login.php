<?php 
include 'config.php';
session_start();

if(isset($_POST['submit'])){
$email=mysqli_real_escape_string($conn, $_POST['email']);
$pass=mysqli_real_escape_string($conn, md5($_POST['password']));


$select = mysqli_query($conn, "SELECT * FROM user_form WHERE email = '$email'") or die('connect failed');
if(mysqli_num_rows($select) >0 ){
    $row = mysqli_fetch_assoc($select);
    $_SESSION['user_id'] = $row['id'];
    header('location: home.php');
}else{
    $message[]= "Incorrect email or password";
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Login now</h3>
            <?php
            if(isset($message)){
                foreach($message as $msg){
                    echo '<div class="message">'.$msg.'</div>';
            }
        }
            ?>
            <input type="email" name="email" placeholder="Enter your email" class="box" required>
            <input type="password" name="password" placeholder="Enter your password" class="box" required>
            <input type="submit" name="submit" value="login" class="btn">
            <p>do not have an account? <a href="register.php">register now</a></p>
        </form>
        
    </div>
</body>
</html>