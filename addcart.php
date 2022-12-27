<?php
session_start();
include 'includes/functions.php';
$user = data($db);
if(isset($_POST['CartItem']))
{
    if($user!=0)
    {
        $user_id = $user['id'];
    }
    else
    {
        $user_id = 0;
    }

        $man_id = $_POST['CartItem'];
        
        $check_product = "SELECT * FROM cart WHERE cart.man_id = $man_id AND cart.user_id = $user_id ";
        
        $run_check = mysqli_query($db,$check_product);
        
        if(mysqli_num_rows($run_check)>0)
        {
            $get_offer = "SELECT * from products where products.product_id = $man_id";
            $run_offer = mysqli_query($db,$get_offer);
            $row_offer = mysqli_fetch_array($run_offer);
            $imagePro = $row_offer['product_img1'];
            $imageName = $row_offer['product_name'];
            echo "<div class='NotificationWindow' id='NotificationWindow'>
            <div class='Notification'>
                <img src='img/$imagePro'  style='width:150px; height:200px; border-radius:15px;'></img>
                <div class='NotiInside'>
                    <div style='text-align: center;'>$imageName has Already Added to your Cart!</div>
                    <button onClick = 'RemoveNot()'>Continue</button>
                </div>
            </div>
            </div>";
            
        }
        else
        {
            $get_offer = "SELECT * from products where products.product_id = $man_id";
            $run_offer = mysqli_query($db,$get_offer);
            $row_offer = mysqli_fetch_array($run_offer);
            $imagePro = $row_offer['product_img1'];
            $imageName = $row_offer['product_name'];
            $price = $row_offer['product_price'];

            $query = "INSERT INTO cart (man_id,user_id,price) values ($man_id,$user_id,$price)";
            
            $run_query = mysqli_query($db,$query);
            echo "<div class='NotificationWindow' id='NotificationWindow'>
                    <div class='Notification'>
                        <img src='img/$imagePro'  style='width:150px; height:200px; border-radius:15px;'></img>
                        <div class='NotiInside'>
                            <div style='text-align: center;'>$imageName Added to Cart!</div>
                            <button onClick = 'RemoveNot()'>Continue</button>
                        </div>
                    </div>
                </div>";
            
        }
        
    }

    ?>
