<?php
include_once('db.php');
$action = false;
if(isset($_POST['save'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $password=$_POST['password'];
    if($_POST['save'] == 'Save'){
        $save_sql = "insert into `users` (`id`, `name`, `email`, `password`, `mobile`) value ('$name', '$email', '$password', '$mobile')";
    }else{
        $id=$_POST['id'];
        $save_sql = "update `users` set `name`='$name', `email`='$email ', `password`='$password', `mobile`='$mobile' where `id`='$id'";
    }
    $res_save = mysqli_query($con, $save_sql);
    if (!$res_save) {
        die(mysqli_error($con));
    
      } else {
        if (isset($_POST['id'])){
          $action = "edit";
        }else{
          $action = "add";
        }
    
      }
    
    }
    if(isset($_GET['action']) && $_GET['action']=="del"){
        $del_sql = "delete from users where id =".$_GET['id'];
        $res_d = mysqli_query($con, $del_sql);
        if($res_d){
            $action = "del";
        } 
    }



    $uses_sql = "select * from users";
    $all_users = mysqli_query($con, $uses_sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>User App</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet'  href='css/bootstrap.min.css'>
    <link rel='stylesheet'  href='css/toaster.css'>
    <script src='main.js'></script>
</head>
<body>
    <div class="container">
        <div class="wrapper p-5 m-5">
            <div class="d-flex p-2 justify-content-between mb-2">
                <h2>All users</h2>
                <div><a href="add_user.php"></a></i></div>
            </div>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while($user = $all_users->fetch_assoc()){?>
                <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['mobile'] ?></td>
                    <td>
                        <div class="d-flex p-2 justify-content-evenly mb-2" >
                    <i onclick="confirm_delete(<?php echo $user['id'];?>)" data-feather="trash-2" class="text-danger"></i>
                    <i onclick="confirm_edit(<?php echo $user['id'];?>)" data-feather="edit" class="text-success"></i></i>
                    </div>
                </td>
                </tr>
<?php
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>


    <script src="js/bootstrap.min.js"></script>
    <script src="js/icon.js"></script>
    <script src="js/toaster.js"></script>
    <script src="js/jq.js"></script>
    <script src="js/main.js"></script>
    <?php

    if($action != false){
    if($action == "add"){?>
    <script>
        show_add();
    </script>
    <?php } 
        if($action == "del"){?>
    <script>
        show_del();
    </script>
    <?php  }
        if($action == "edit"){?>
    <script>
        edit();
    </script>
    <?php } } ?>
    <script>
        feather.replaces();

    </script>
</body>
</html>