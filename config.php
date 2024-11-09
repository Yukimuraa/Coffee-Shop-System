<?php
$connection = mysqli_connect("localhost","root","","coffee_shop");
    if(!$connection){
        die("connection".mysqli_connect_error());
    }else{
        // echo "Success";
    }

?>