<?php
session_start();
include 'includes/functions.php';
$user = data($db);

if($user == 0)
{
    header("Location: index.php");
}
else
{
    $user_id = $user['id'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['decline']))
    {
        $offer_id = $_POST['decline'];
        mysqli_query($db,"DELETE from offers where offers.offer_id = $offer_id");
    }
    if(isset($_POST['accept']))
    {
        $offer_id = $_POST['accept'];

        $get_offer = "SELECT * from offers where offers.offer_id = $offer_id";
        $run_offer = mysqli_query($db,$get_offer);
        $row_offer = mysqli_fetch_array($run_offer);

        $product_id = $row_offer['product_id'];
        $final_price = $row_offer['final_price'];

        mysqli_query($db,"INSERT INTO cart (man_id,user_id,price) values ($product_id,$user_id,$final_price)");
        mysqli_query($db,"DELETE from offers where offers.offer_id = $offer_id");
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

<form action="offers.php" method="POST">
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>final price</th>
            <th>Accept</th>
            <th>Decline</th>
        </tr>

        <?php

            $get_offer = "SELECT * from offers where offers.user_id = $user_id";
            $run_offer = mysqli_query($db,$get_offer);

            while($row_offer=mysqli_fetch_array($run_offer))
            {
                $product_id = $row_offer['product_id'];
                $final_price = $row_offer['final_price'];


                $get_pro = "SELECT * from products where products.product_id = $product_id";
                $run_pro = mysqli_query($db,$get_pro);

                $row_pro = mysqli_fetch_array($run_pro);
                



        ?>


        <tr>
            <td><?php echo $row_offer['offer_id']; ?></td>
            <td><?php echo $row_pro['product_name'];?></td>
            <td><?php echo $final_price; ?>€</td>
            <td><button type="submit" name="accept" value="<?php echo $row_offer['offer_id']; ?>">Accept</button></td>
            <td><button type="submit" name="decline" value="<?php echo $row_offer['offer_id']; ?>">Decline</button></td>

        </tr>

        <?php } ?>
</table>
</form>

</body>
</html>