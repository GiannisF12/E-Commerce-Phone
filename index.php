<?php
session_start();
include 'includes/functions.php';
$user = data($db);



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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="notification.js" defer></script>
        <script src="add_cart.js" defer></script>
    </head>
    <body>
        <div style="position: relative;">
            <?php include 'includes/navbar.php'; ?>

            <div class="products">

                <?php 
                    if(!isset($_GET['man']))
                    {
                        $get_products = "SELECT * from products";
                    }
                    else
                    {
                        $man_id = $_GET['man'];
                        $get_products = "SELECT * FROM products where man_id = $man_id";
                    }
                    $run_products = mysqli_query($db,$get_products);
                    while($row_products=mysqli_fetch_array($run_products))
                    {
                        $pro_id = $row_products['product_id'];
                        $pro_title = $row_products['product_name'];
                        $pro_price = $row_products['product_price'];
                        $pro_img1 = $row_products['product_img1'];
                    
                ?>



                <div class="card">

                    <img src="img/<?php echo $pro_img1 ?>"  style="width:250px; height:300px"></img>
                    <h1><?php echo $pro_title ?></h1>
                    <p class="price"><?php echo $pro_price ?>€</p>
                    <p><button class="addCart" name="add_cart" value="<?php echo $pro_id?>">Add to Cart</button></p>
                </div>
                <?php } ?>
                
            </div>
        </div>
        <div id="AddNoti">
            
        </div>
    </body>
</html>