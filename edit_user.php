<?php
session_start();
include 'includes/functions.php';
$user = data($db);

if($user['permission'] != 'Admin')
{
    header("Location: index.php");
}


if(isset($_GET['edit']))
{
        
    $edit_user = $_GET['edit'];
    $get_user = "SELECT * from users where id='$edit_user'";
    $run_user = mysqli_query($db,$get_user);
    $row_user = mysqli_fetch_array($run_user);
        
    $user_id1 = $row_user['id'];
    $user_name1 = $row_user['username'];
    $user_pass1 = $row_user['password'];
    $user_email1 = $row_user['email'];
    $user_permission1 = $row_user['permission'];
        
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Kodinger">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Edit Users</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php include 'includes/navbar.php'; ?>

        <form class="edit_form" method="POST">
            <div class="inside_form">
                <label>Username</label>
                <input class="edit" value="<?php echo $user_name1; ?>" name="username" type="text" class="form-control" required>
                <label>Email</label>
                <input class="edit" value="<?php echo $user_email1; ?>"  name="email" type="text" class="form-control" required>
                <label>Password</label>
                <input class="edit" value="<?php echo $user_pass1; ?>"  name="password" type="password" class="form-control" required>
                <label>Permission</label>
                <select class="edit" value="<?php echo $user_permission1; ?>"  name="permission" class="form-control" required>
                    <option value="Member">Member</option>
                    <option value="Admin">Admin</option>
                </select>

                <br><br>
                <button type="sumbit" name="update" class="btn btn-primary btn-block">Edit User</button>
                </div>
        </form>


    </body>

    <?php 

        if(isset($_POST['update']))
        {
            $user_name1 = $_POST['username'];
            $user_email1 = $_POST['email'];
            if($user_pass1 != $_POST['password'])
            {
                $user_pass1 = md5($_POST['password']);
            }
            else
            {
                $user_pass1 = $_POST['password'];
            }
            $user_permission1 = $_POST['permission'];
            
            $update_user = "UPDATE users set username='$user_name1',email='$user_email1',password='$user_pass1',permission='$user_permission1' where id='$user_id1'";
            $run_user = mysqli_query($db,$update_user);
            if($run_user)
            {
                echo "<script>alert('User has been updated sucessfully')</script>";
                echo "<script>window.open('users.php','_self')</script>";
            }
            
        }
    ?>


</html>