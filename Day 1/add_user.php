<?php
include_once('db.php');
$title="Add";
$name="";
$mobile="";
$password="";
$email="";
$btn="Save";
    if(isset($_GET['action']) && $_GET['action']=='edit'){
        $id = $_GET['id'];
        $sqll = "SELECT * FROM users WHERE id = '$id'";
        $user = mysqli_query($con, $sqll);
        if($user){
            $btn="Update";
            $title = "Update";
            $cur_usr = $user->fetch_assoc();
            $name=$cur_usr['name'];
            $mobile=$cur_usr['mobile'];
            $password=$cur_usr['password'];
            $email=$cur_usr['email'];
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet'  href='css/bootstrap.min.css'>
    <script src='main.js'></script>
</head>
<body>
    <div class="container">
        <div class="wrapper p-5 m-5">
            <div class="d-flex p-2 justify-content-between">
                <h2><?php $title; ?> users</h2>
                <div><a href="index.php"></a><i data-feather="corner-down-left"></i></div>
            </div>
        </div>
        <form action="index.php" method="post"> <div class="mb-3">
        <div class="mb-3">
            <label class="form-label">Name</label> 
            <input type="text" class="form-control" placeholder="enter your name" name="name" autocomplete="false" value="<?php echo $name ?>">
        </div>
        <div class="mb-3">
            <label class="form-label"> Email</label> 
            <input type="email" class="form-control" placeholder="enter your email" name="email" autocomplete="false" value="<?php echo $email ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Mobile</label>
            <input type="tel" class="form-control" placeholder="enter your phone number" name="mobile" autocomplete="false" value="<?php echo $mobile ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" placeholder="password" name="password" autocomplete="false" value="<?php echo $password ?>">
        </div>
        <?php 
        if(isset($_GET['id'])){?>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

<?php        }
        ?>
        <input type="submit" class="btn btn-primary" value="<?php $btn; ?>" name=save>
</form>
        </div>


    <script src="js/bootstrap.min.js"></script>
    <script src="js/icon.js"></script>
    <script>
        feather.replaces()
    </script>
</body>
</html>