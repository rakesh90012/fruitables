<?php

include './db/connect.php';
$product_id = $_GET['product_id'];

$sql = "DELETE FROM products WHERE id='$product_id'";

$result = $conn->query($sql);
if($result){
    header("Location: profile.php?success='Deleted Successfully!'");
}else{
    echo "something went wrong";
}
