<?php
session_start();
include 'includes/functions.php';
$user = data($db);

if($user==0)
{
    header("Location: index.php");
}

if(isset($_GET['update_self']))
{
        
    $edit_user = $_GET['update_self'];
    $get_user = "select * from users where id=$edit_user";
    $run_user = mysqli_query($db,$get_user);
    $row_user = mysqli_fetch_array($run_user);
        
    $user_id = $row_user['id'];
    $user_name = $row_user['username'];
    $user_pass = $row_user['password'];
    $user_email = $row_user['email'];
    $user_country = $row_user['country'];
    $user_state = $row_user['state'];
    $user_city = $row_user['city'];
    $user_street = $row_user['street'];
    $user_zip = $row_user['zip'];
        
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Kodinger">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php include 'includes/navbar.php'; ?>

        <form class="edit_form" method="post" enctype="multipart/form-data" action="profile.php?update_self=<?php echo $_GET['update_self'];?>">
            <div class="inside_form">
                <label>Username</label>
                <input class="edit" value="<?php echo $user_name; ?>" name="username" type="text" class="form-control" required>

                <label>Email</label>
                <input class="edit" value="<?php echo $user_email; ?>"  name="email" type="text" class="form-control" required>

                <label>Password</label>
                <input class="edit" value="<?php echo $user_pass; ?>"  name="password" type="password" class="form-control" required>

                <label>Country</label>
                <input class="edit" value="<?php echo $user_country; ?>" name="country" type="text" class="form-control" required>

                <label>State</label>
                <input class="edit" value="<?php echo $user_state; ?>" name="state" type="text" class="form-control" required>

                <label>City</label>
                <input class="edit" value="<?php echo $user_city; ?>" name="city" type="text" class="form-control" required>

                <label>Street</label>
                <input class="edit" value="<?php echo $user_street; ?>" name="street" type="text" class="form-control" required>

                <label>Zip Code</label>
                <input class="edit" value="<?php echo $user_zip; ?>" name="zip" type="text" class="form-control" required>


                <br><br>
                <input name="update" value="Edit" type="submit" class="btn btn-primary form-control">
                </div>

            

        </form>


        <?php 

        if(isset($_POST['update']))
        {
            $user_name = $_POST['username'];
            $user_email = $_POST['email'];

            $user_country = $_POST['country'];
            $user_state = $_POST['state'];
            $user_city = $_POST['city'];
            $user_street = $_POST['street'];
            $user_zip = $_POST['zip'];

            if($user_pass != $_POST['password'])
            {
                $user_pass = md5($_POST['password']);
            }
            else
            {
                $user_pass = $_POST['password'];
            }

            
            
            $update_user = "update users set username='$user_name',email='$user_email',password='$user_pass',country='$user_country',state='$user_state',city='$user_city',street='$user_street',zip='$user_zip' where id='$user_id'";
            $run_user = mysqli_query($db,$update_user);
            if($run_user)
            {
                echo "<script>alert('Settings updated sucessfully')</script>";
                echo "<script>window.open('profile.php?update_self=$edit_user','_self')</script>";
            }
            
        }
    ?>


    </body>

    


</html>