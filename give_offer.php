<?php
session_start();
include 'includes/functions.php';
$user = data($db);

if($user['permission'] != 'Admin')
{
    header("Location: index.php");
}

if (isset($_POST['submit'])) 
{
    $pro_id = $_POST['product'];
    $user_id = $_POST['user'];
    $percent = $_POST['percent'];

    $get_pro = "SELECT * from products where products.product_id = $pro_id";
    $run_pro = mysqli_query($db,$get_pro);
    $row_pro = mysqli_fetch_array($run_pro);

    $final_price = ($percent/100)*$row_pro['product_price'];

    $offer = "INSERT INTO offers (product_id,user_id,final_price) values ($pro_id,$user_id,$final_price)";
    mysqli_query($db,$offer);
    

}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Kodinger">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Products</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>

    <?php include 'includes/navbar.php'; ?>

    <form action="give_offer.php" method="POST">
        <select name="product" required>
            <optgroup>
                <?php 
                $get_pro = "SELECT * from products";
                $run_pro = mysqli_query($db,$get_pro);
                while($row_pro=mysqli_fetch_array($run_pro))
                {
                ?>
                <option value="<?php echo $row_pro['product_id'];?>"><?php echo $row_pro['product_name'];?></option>
                <?php } ?>
            </optgroup>
        </select>
        <select name="user" required>
            <optgroup>
                <?php 
                $get_users = "SELECT * from users";
                $run_users = mysqli_query($db,$get_users);

                while($row_users=mysqli_fetch_array($run_users))
                {
                ?>
                <option value="<?php echo $row_users['id'];?>"><?php echo $row_users['username'];?></option>
                <?php } ?>
            </optgroup>
        </select>
        <input type="number" placeholder="sale percent(%)" name="percent" required>
        <button type="submit" name="submit">Give offer</button>
    </form>
    </body>
</html>