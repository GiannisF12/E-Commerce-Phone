<?php
session_start();
include 'includes/functions.php';
$user = data($db);

if($user['permission'] != 'Admin')
{
    header("Location: index.php");
}

if(isset($_GET['delete_user']))
{
    $delete_id = $_GET['delete_user'];
    $delete_user = "DELETE from users where id='$delete_id'";
    $run_delete = mysqli_query($db,$delete_user);
    if($run_delete)
    {
        echo "<script>alert('User has been Deleted')</script>";
        echo "<script>window.open('users.php','_self')</script>";
    }
}

if(isset($_GET['ban_user']))
{
    $ban_id = $_GET['ban_user'];
    $querry = mysqli_query($db,"SELECT * from users where id='$ban_id'");
    $result = mysqli_fetch_array($querry);
    if($result['Banned']==0)
    {
        $ban_user = "UPDATE users set Banned=1 where id='$ban_id'";
    }
    else
    {
        $ban_user = "UPDATE users set Banned=0 where id='$ban_id'";
    }
    
    $run_ban = mysqli_query($db,$ban_user);
    if($run_ban)
    {
        echo "<script>alert('User has been Banned')</script>";
        echo "<script>window.open('users.php','_self')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Users</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>


    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Permission</th>
            <th>Banned</th>
            <th>Edit</th>
            <th>Ban/Unban</th>
            <th>Delete</th>
        </tr>

        <?php

            $get_users = "SELECT * from users";
            $run_users = mysqli_query($db,$get_users);

            while($row_users=mysqli_fetch_array($run_users))
            {
                $user_id = $row_users['id'];
                $user_name = $row_users['username'];
                $user_email = $row_users['email'];
                $user_pass = $row_users['password'];
                $user_permission = $row_users['permission'];
                $user_banned = $row_users['Banned'];


        ?>


        <tr>
            <td><?php echo $user_id;?></td>
            <td><?php echo $user_name; ?></td>
            <td><?php echo $user_email;?></td>
            <td><?php echo $user_pass;?></td>
            <td><?php echo $user_permission;?></td>
            <td>
                <?php if($user_banned == 0) echo "No";?>
                <?php if($user_banned == 1) echo "Yes"; ?>
            </td>
            <td><a href="edit_user.php?edit=<?php echo $user_id; ?>">Edit</a></td>
            <td><a href="users.php?ban_user=<?php echo $user_id; ?>">Ban/Unban</td>
            <td><a href="users.php?delete_user=<?php echo $user_id; ?>">Delete</td>

        </tr>

        <?php } ?>
</table>


</body>
</html>