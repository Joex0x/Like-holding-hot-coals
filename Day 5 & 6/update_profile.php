<?php

include 'config.php';
session_start();
$user_id=$_SESSION['user_id'];

if(isset($_POST['update_id'])){
    $update_name=mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_email=mysqli_real_escape_string($conn, $_POST['update_email']);

    mysqli_query($conn, "update `user_form` set name = '$update_name', email='$update_email' where id = '$user_id' or die('query failed')");

    $old_pass = $_POST['old_pass'];
    $upadate_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
    $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
    $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confrim_pass']));

    if(!empty($upadate_pass) || !empty($new_pass) || !empty($confirm_pass)){
        if($upadate_pass != $old_pass){
            $message[]='old password not matched!';
        }elseif($new_pass != $confirm_pass){
            $message[]='confrim password not matched';
        }else{
            mysqli_query($conn, "update `user_form` set password = '$confirm_pass' where id = '$user_id'") or die('query failed');
            $message[]= 'password updated successfully';
        }
    }

    $update_image = $_FILES['update_image']['image'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = 'updated_img/'.$update_image;

    if(!empty($update_image)){
        if($update_image_size > 20000000){
            $message[] = 'image is to large';
        }else{
            $image_update_query = mysqli_query($conn, "update `user_form` set image = '$update_image' where id = '$user_id'") or die('query failed');
            if($image_update_query){
                move_uploaded_file($update_image_tmp_name, $update_image_folder);
            }
            $message[] = 'image updated successfully';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Update Profile</title>
</head>
<body>
    <div class="update-profile">
    <?php 
            $select = mysqli_query($conn, "select * from user_form where user_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows( $select ) > 0){
                $fetch = mysqli_fetch_array($select);
            }
            if($fetch['image'] == ''){
                echo '<img src="images/default-avatar.png">';
            }else{
                echo '<img src="images/'.$fetch['image'].'">';
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <?php
                if($fetch['image'] == ''){
                    echo '<img src="images/default-avatar.png">';
                }else{
                    echo '<img src="images/'.$fetch['image'].'">';
                }
                ?>
                <div class="flex">
                    <div class="inputBox">
                        <span>username : </span>
                        <input type="text" name="update_name" value="<?php echo $fetch['name']?>" class="box">
                        <span>your email : </span>
                        <input type="email" name="update_email" value="<?php echo $fetch['email']?>" class="box">
                        <span>update your image : </span>
                        <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
                    </div>
                    <div class="inputBox">
                        <input type="hidden" name="old_name" value="<?php echo $fetch['name']?>" class="box">
                        <span>old password : </span>
                        <input type="password" name="update_pass" placeholder="enter previous password" class="box">
                        <span>new password : </span>
                        <input type="password" name="new_pass" placeholder="enter new password" class="box">
                        <span>confirm password : </span>
                        <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
                    </div>
                </div>
                <input type="submit" value="update Profile" name="update_profile" class="btn">
                <a href="home.php" class="delete-btn">back</a>
            </form>
    </div>
</body>
</html>