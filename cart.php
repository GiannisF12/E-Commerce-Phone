<?php
session_start();
include 'includes/functions.php';
$user = data($db);


if (isset($_SESSION['id'])) 
{
  $user_id = $user['id'];
}
else
{
  $user_id = 0;
}


if(isset($_POST['delete']))
{
                    
  $delete_id = $_POST['delete'];
  $delete_pro = "DELETE from cart where cart.man_id='$delete_id' and cart.user_id = $user_id";
        
  $run_delete = mysqli_query($db,$delete_pro);
  if($run_delete)
  {
    echo "<script>window.open('cart.php','_self')</script>";     
  }
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Kodinger">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Cart</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>

      <?php include 'includes/navbar.php'; ?>


      <div class="row">
        <div class="col-75">
          <div class="container">
            <form action="/action_page.php">
            
              <div class="row">
              <?php if($user==0): ?>
                <div class="col-50">
                  <h3>Billing Address</h3>
                  <label for="fname"><i class="fa fa-user"></i> Username</label>
                  <input type="text" id="fname" name="firstname" value="">
                  <label for="email"><i class="fa fa-envelope" ></i> Email</label>
                  <input type="text" id="email" name="email" value="">
                  <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                  <input type="text" id="adr" name="address" value="">
                  <label for="city"><i class="fa fa-institution"></i> City</label>
                  <input type="text" id="city" name="city" value="">

                  <div class="row">
                    <div class="col-50">
                      <label for="state">State</label>
                      <input type="text" id="state" name="state" value="">
                    </div>
                    <div class="col-50">
                      <label for="zip">Zip</label>
                      <input type="text" id="zip" name="zip" value="">
                    </div>
                  </div>
                </div>

              <?php else: ?>
                <div class="col-50">
                  <h3>Billing Address</h3>
                  <label for="fname"><i class="fa fa-user"></i> Username</label>
                  <input type="text" id="fname" name="firstname" value="<?php echo $user['username']; ?>">
                  <label for="email"><i class="fa fa-envelope" ></i> Email</label>
                  <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>">
                  <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                  <input type="text" id="adr" name="address" value="<?php echo $user['street']; ?>">
                  <label for="city"><i class="fa fa-institution"></i> City</label>
                  <input type="text" id="city" name="city" value="<?php echo $user['city']; ?>">

                  <div class="row">
                    <div class="col-50">
                      <label for="state">State</label>
                      <input type="text" id="state" name="state" value="<?php echo $user['state']; ?>">
                    </div>
                    <div class="col-50">
                      <label for="zip">Zip</label>
                      <input type="text" id="zip" name="zip" value="<?php echo $user['zip']; ?>">
                    </div>
                  </div>
                </div>
              <?php endif ?>

                <div class="col-50">
                  <h3>Payment</h3>
                  <label for="fname">Accepted Cards</label>
                  <div class="icon-container">
                    <i class="fa fa-cc-visa" style="color:navy;"></i>
                    <i class="fa fa-cc-mastercard" style="color:orange;"></i>
                  </div>
                  <label for="cname">Name on Card</label>
                  <input type="text" id="cname" name="cardname">
                  <label for="ccnum">Credit card number</label>
                  <input type="text" id="ccnum" name="cardnumber">
                  <label for="expmonth">Exp Month</label>
                  <input type="text" id="expmonth" name="expmonth">
                  <div class="row">
                    <div class="col-50">
                      <label for="expyear">Exp Year</label>
                      <input type="text" id="expyear" name="expyear">
                    </div>
                    <div class="col-50">
                      <label for="cvv">CVV</label>
                      <input type="text" id="cvv" name="cvv">
                    </div>
                  </div>
                </div>
                
              </div>
              <label>
                <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
              </label>
              <input type="submit" value="Continue to checkout" class="btn">
            </form>
          </div>
        </div>





        <div class="col-25">
        <form action="cart.php" method="post">
          <div class="container">
            <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> </span></h4>

            <?php
                if($user!=0)
                {
                  $user_id = $user['id'];
                }
                else
                {
                  $user_id = 0;
                }
                $get_products = "SELECT * from cart where cart.user_id = $user_id order by id ";

                $total_price = 0;

                $run_products = mysqli_query($db,$get_products);
                while($row_products=mysqli_fetch_array($run_products))
                {
                  $pro_id = $row_products['man_id'];
                  $select_pro = mysqli_query($db,"SELECT * from products where products.product_id = $pro_id ");
                  $result_cart = mysqli_fetch_array($select_pro);
                  
                  $product_id = $result_cart['product_id'];
                  
                  $pro_title = $result_cart['product_name'];
                  
                  $pro_price = $row_products['price'];

                  $total_price = $total_price + $pro_price;
                

            
            ?>

            <p><a href="#"><?php echo $pro_title; ?></a><button class="del" type = "submit" name = "delete" value = '<?php echo $product_id; ?>'>X</button> <span class="price"><?php echo $pro_price ?>€</span></p>
            
            <?php } ?>
            <hr>
            <p>Total <span class="price" style="color:black"><b><?php echo $total_price; ?>€</b></span></p>
          </div>
        </form>
        </div>
    </div>
    
  </body>
</html>