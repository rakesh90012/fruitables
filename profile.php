<?php

include './header.php';

require './db/connect.php';
$user_id = $_SESSION['user_id'];

$error_message = '';
$success_message = '';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE users SET fullname='$name', email='$email', phone='$phone' WHERE id='$user_id'";

    $result = $conn->query($sql);

    if($result){
        $success_message = "Profile Updated Successfully!";
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;

    }else{
        $error_message = "Something went wrong";
    }
}



?>

<div class="container-fluid py-5 my-5">
    <div class="container my-5 py-5">
        <form action="" method='post'>
            <?php
                if(!empty($error_message)){?>
                <div class="alert alert-danger"><?php echo $error_message ?></div>
                <?php } ?>
            <?php
                if(!empty($success_message)){?>
                <div class="alert alert-success"><?php echo $success_message ?></div>
                <?php } ?>
            <div class="my-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name='name' value="<?php echo $_SESSION['name']; ?>">
            </div>
            <div class="my-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name='email' value="<?php echo $_SESSION['email']; ?>">
            </div>
            <div class="my-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="number" class="form-control" name='phone' value="<?php echo $_SESSION['phone']; ?>">
            </div>
            <button class="btn btn-primary">Update</button>
            <?php //echo $_GET['nam'], $_GET['age']; ?>
        </form>
        <div class="contianer">
            <?php if($_SESSION['user_type'] == 'vendor'){
                $sql = "SELECT * FROM products WHERE vendor_id='$user_id'";
                $result = $conn->query($sql);
                $num_rows = $result->num_rows;
                $data = [];
                for ($i=0; $i < $num_rows; $i++) { 
                   $data[] = $result->fetch_assoc();
                }
                ?>
                    <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="tab-class text-center">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        <?php for($i=0; $i<$num_rows; $i++){ ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="<?php echo $data[$i]['image']; ?>" class="img-fluid w-100 rounded-top" alt="" style="height: 200px;">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4><?php echo $data[$i]['product_name']; ?></h4>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <a href="update-product.php?prduct_id=<?php echo $data[$i]['id']; ?>" class="btn border border-secondary rounded-pill px-3 text-primary">Custumize</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
        <!-- Fruits Shop End-->
           <?php } ?>
        </div>
    </div>
</div>


<?php

include './footer.php';

?>