<?php 
include 'config.php';

if(isset($_POST['submit'])){
    $message = [];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = $_POST['cpassword'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die("Query failed");

    if(mysqli_num_rows($select) > 0){
        $message[] = "Email exists";
    } else {
        if(!password_verify($cpass, $pass)){
            $message[] = "Passwords not matched";
        } elseif($image_size > 2000000){
            $message[] = "Image size is too large";
        } else {
            $insert = mysqli_query($conn, "INSERT INTO `user_form` (name, email, password, image) VALUES ('$name', '$email', '$pass', '$image')") or die("Query failed");
            if($insert){
                if(move_uploaded_file($image_tmp_name, $image_folder)){
                    $message[] = "Registered successfully";
                } else {
                    $message[] = "Failed to upload image";
                }
            } else {
                $message[] = "Registration failed";
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Register now</h3>
            <?php
            if(isset($message)){
                foreach($message as $msg){
                    echo '<div class="message">'.$msg.'</div>';
            }
        }
            ?>
            <input type="text" name="name" placeholder="Enter your name" class="box" required>
            <input type="email" name="email" placeholder="Enter your email" class="box" required>
            <input type="password" name="password" placeholder="Enter your password" class="box" required>
            <input type="password" name="cpassword" placeholder="Confirm password" class="box" required>
            <input type="file" class="box" name="image" accept="image/jpg, image/jpeg, image/png">
            <input type="submit" name="submit" class="btn" value="register now">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>
        
    </div>
</body>
</html>