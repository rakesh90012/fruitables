<?php

include './header.php';

require './db/connect.php';

$product_id = $_GET['prduct_id'];

$error_message = '';
$success_message='';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $pdname = $_POST['pdname'];
    $pdprice = $_POST['pdprice'];
    $desc = $_POST['pddesc'];
    $category = $_POST['category'];
    
    $sql = "UPDATE products SET product_name='$pdname', price='$pdprice', description='$desc', category='$category' WHERE id='$product_id'";
    
    if($conn->query($sql)){
        $success_message = "Product Updated Successfully!";
    }else{
        $error_message = "Something went wrong!";
    }
}


?>


<div class="container my-5 py-5">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row my-5 ">
            <?php 
                if(!empty($error_message)){
            ?>
            <div class="alert alert-danger">
                <?php echo $error_message ?>
            </div>
            <?php } ?>
            <?php 
                if(!empty($success_message)){
            ?>
            <div class="alert alert-success">
                <?php echo $success_message ?>
            </div>
            <?php } ?>

            <?php 
             
             $sql = "SELECT * FROM products WHERE id='$product_id'";
             $result = $conn->query($sql);
             $product = $result->fetch_assoc();
            //  print_r($product);
            ?>
            <div class="my-2">
                <label for="pdname" class="form-label">Product Name</label>
                <input type="text" id="pdname" class="form-control" name="pdname" value="<?php echo $product['product_name'] ?>">
            </div>
            <?php //echo $_GET['prduct_id']; ?>
            <div class="my-2">
                <label for="pdprice" class="form-label">Product Price</label>
                <input type="number" id="pdprice" class="form-control" name="pdprice" value="<?php echo $product['price'] ?>">
            </div>
            <div class="my-2">
                <label for="pddesc" class="form-label">Description</label>
                <input type="text" id="pddesc" class="form-control" name="pddesc" value="<?php echo $product['description'] ?>">
            </div>
            <?php //echo $product['category'] ?>
            <div class="my-2">
                <label for="pddesc" class="form-label">Categorey</label>
                <select name="category" id="category" class="form-control">
                    <option value="vegetables" <?php echo $product['category']=='vegetables'?'selected':''?>>Vegetables</option>
                    <option value="fruits" <?php echo $product['category']=='fruits'?'selected':''?>>Fruits</option>
                    <option value="bread" <?php echo $product['category']=='bread'?'selected':''?>>Bread</option>
                    <option value="meet" <?php echo $product['category']=='meet'?'selected':''?>>Meet</option>
                </select>
            </div>
            <div>
                <button class="btn btn-primary mt-3">
                    Update
                </button>
                <a href="delete-product.php?product_id=<?php echo $product['id'] ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </form>
    
</div>


<?php

include './footer.php';

?>