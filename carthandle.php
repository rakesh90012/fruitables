<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $product_id = $_POST['product_id'];
    $allData = [];
    unset($_SESSION['products_added_to_cart']['product-'.$product_id]);
    $arr = $_SESSION['products_added_to_cart'];
    foreach($arr as $value){
        $allData[] = $value;
    }

    echo json_encode($allData);
}