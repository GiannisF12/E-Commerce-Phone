<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "phonedb";

$db = mysqli_connect($server, $user, $pass, $database);

if (!$db) 
{
    die("<script>alert('Connection Failed.')</script>");
}

function data($db)
{
    if(isset($_SESSION['id'])) //tsekarei an exei dedomena
    {
        $id=$_SESSION['id'];
    
        $sql = " SELECT * FROM users WHERE users.id=$id "; //epilegei ton xrhsth pou eimaste sindedemenoi
        $result = mysqli_query($db, $sql); // ektelei to erwtima sql
        if ($result->num_rows > 0) // an uparxei panw apo 0 seires diladi apotelesma
        {
            $row = mysqli_fetch_array($result); //pinaka me seira kai ton bazei se seira
            return $row;
        }
        else
        {
            return 0; // simainei den eimaste sindedemenei se xrhsth
        } 
    }
    else
    {
        return 0; // simainei den eimaste sindedemenei se xrhsth
    }
    
}



?>