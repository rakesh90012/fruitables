<?php 
// session_start();
include "./header.php";
require './db/connect.php';
echo "<br>";
echo "<br>";
$error_message='';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    $totalNoOfRows = "No of rows: ".$result->num_rows;

    $data = $result->fetch_assoc();

    if($data['password'] == $pass){
        $_SESSION['name'] = $data['fullname'];
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['phone'] = $data['phone'];
        $_SESSION['user_type'] = $data['user_type'];

    }else{
        $error_message = "Wrong Password";
    }

}


?>

<div class="container-fluid my-5 py-5">
    <div class="container py-5">
        <div class="form-group">
            <form action="" method="post">
            <?php 
                    if(!empty($error_message)){
                        echo "<p class='alert alert-danger'>$error_message</p>";
                    }
                    if(!empty($successMessage)){
                        echo "<p class='alert alert-success'>$successMessage</p>";
                    }
                ?>
                <div class="row">
                    <div class="my-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" name="email">
                    </div>
                    <div class="my-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" id="password" class="form-control" name="password">
                    </div>
                    <div>
                        <button class="btn btn-primary mt-3">
                            Log In
                        </button>
                    </div>
                    <a href="" class="mt-3">Forget Password</a>
                    <a href="signup.php" class="mt-3">You don't have account?</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 

include "./footer.php";

?>