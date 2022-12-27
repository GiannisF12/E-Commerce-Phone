<div class="nav">
    <a href="index.php">Home</a>
    <a href="index.php">Product</a>
    <div class="dropdown">
        <button class="btn nav-button dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Manufactor
        </button>
        <a href="offers.php">My offers</a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

            <?php
                $get_man = "SELECT * from manufactor ";
                $run_man = mysqli_query($db,$get_man);
                while($row_man=mysqli_fetch_array($run_man))
                    {
                        $man_name = $row_man['man_name'];
                        $man_id = $row_man['man_id'];
            ?>



            <a class="dropdown-item" href="index.php?man=<?php echo $man_id ?>"><?php echo $man_name ?></a>

            <?php } ?>

        </div>
    </div>
    <div class="nav-right">
        <?php if($user==0): ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="cart.php">Cart</a>
        <?php else: ?>
            <div class="name-text"><?php echo $user['username'] ?></div>

                <?php 
                    $user_id = $user['id'];
                    $user_name = $user['username'];
                    $user_email = $user['email'];
                    $user_pass = $user['password'];
                ?>

                    <?php if($user['permission']=="Admin"): ?>
                        <a href="users.php">Users</a>
                        <a href="give_offer.php">Give Offer</a>
                    <?php endif ?>

                    <div class="name-text">||</div>

                <a href="profile.php?update_self=<?php echo $user_id; ?>">Profile</a>
                <a href="cart.php?update_self=<?php echo $user_id; ?>">Cart</a>
                <a href="logout.php">Logout</a>
        <?php endif ?>
    </div> 
</div>