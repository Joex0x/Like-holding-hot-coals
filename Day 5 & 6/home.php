<?php
include "config.php";
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header("location: login.php");
}
if(!isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="profile">
            <?php 
                $select = mysqli_query($conn,"SELECT * FROM user_form WHERE id='$user_id'") or die('query failed');
                if(mysqli_num_rows( $select ) > 0){
                $fetch = mysqli_fetch_array($select);
            }
            if($fetch['image'] == ''){
                echo "<div class='logo'><img src='images/default.png'></div>";
            }else{
                echo "<div class='logo'><img src='uploaded_imgs/".$fetch['img']."'></div>";
            }
            ?>
            <h3>hello <?php echo $fetch['name']; ?></h3>
            <a href="update_proflie.php" class="btn">Update Profile</a>
            <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-btn">Logout</a>
            
        </div>
    </div>
</body>
</html>