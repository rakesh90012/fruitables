<?php

include './header.php';

require './db/connect.php';

$error_message = '';
$success_message='';
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(empty($_SESSION['user_id'])){
        header('Location: /login.php');
    }
    $pdname = $_POST['pdname'];
    $pdprice = $_POST['pdprice'];
    $desc = $_POST['pddesc'];
    $category = $_POST['category'];
    $vendor_id = $_SESSION['user_id'];
    
    if(empty($pdname) || empty($pdprice) || empty($desc) || empty($category)){
        $error_message = "Please fill all the credentials!";
        // exit();
    }
    
    $target = 'img/';
    $uploded_file = $_FILES['pdimg'];
    $path = $target.$uploded_file['name'];
    $tempath = $uploded_file['tmp_name'];

    // if ($uploded_file['size'] > 1024000) {
    //     $error_message = 'File size should be less than 1 MB';
    //     // exit();
    // }
    // echo "file status: ".move_uploaded_file($tempath, $path);
    if(move_uploaded_file($tempath, $path)){
        $sql = "INSERT INTO products (product_name, price, description, category, image, vendor_id) VALUES ('$pdname', '$pdprice', '$desc', '$category', '$path', '$vendor_id')";
        if($conn->query($sql)){
            $success_message = "Product Created Successfully!";
        }else{
            $error_message = "Product not created!";
        }
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

            <div class="my-2">
                <label for="pdname" class="form-label">Product Name</label>
                <input type="text" id="pdname" class="form-control" name="pdname" required>
            </div>
            <div class="my-2">
                <label for="pdprice" class="form-label">Product Price</label>
                <input type="number" id="pdprice" class="form-control" name="pdprice" required>
            </div>
            <div class="my-2">
                <label for="pddesc" class="form-label">Description</label>
                <input type="text" id="pddesc" class="form-control" name="pddesc" required>
            </div>
            <div class="my-2">
                <label for="pddesc" class="form-label">Categorey</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="vegetables">Vegetables</option>
                    <option value="fruits">Fruits</option>
                    <option value="bread">Bread</option>
                    <option value="meet">Meet</option>
                </select>
            </div>
            <div class="my-2">
                <label for="pdimg" class="form-label">Product Image</label>
                <input type="file" id="pdimg" class="form-control" name="pdimg" accept="image/*" required>
            </div>
            <div>
                <button class="btn btn-primary mt-3">
                    Create
                </button>
            </div>
        </div>
    </form>
    
</div>


<?php

include './footer.php';

?>