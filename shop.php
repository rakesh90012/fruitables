<?php 

include "./header.php";
include './db/connect.php';

$sql = "SELECT * FROM products";

$result = $conn->query($sql);

$data = [];

$num_rows = $result->num_rows;
$rows = $result->num_rows;

while($num_rows > 0){
    $data[] = $result->fetch_assoc();
    $num_rows--;
}

$sql = "SELECT category, COUNT(id) AS count FROM products GROUP BY category";

$category_count = $conn->query($sql);
$category_count_no = $category_count->num_rows;


?>


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Shop</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Shop</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
            <div class="alert alert-success alert-dismissible fade show alert-message-for-success-add-to-cart" style="position:fixed; bottom:50px; right: 0; display:none" role="alert">
                <strong>Product Added To Cart</strong>
                <button type="button" style="position:absolute; right:0;background: none; border: none; font-size: 32px; top: 5px;" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <h1 class="mb-4">Fresh fruits shop</h1>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-xl-3">
                                <div class="input-group w-100 mx-auto d-flex">
                                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-xl-3">
                                <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                    <label for="fruits">Default Sorting:</label>
                                    <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                        <option value="volvo">Nothing</option>
                                        <option value="saab">Popularity</option>
                                        <option value="opel">Organic</option>
                                        <option value="audi">Fantastic</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                        <div class="col-lg-4 col-xl-3">
                        <div class="row g-4 fruite">
                            <div class="col-lg-12">
                                
                                <div class="mb-4">
                                    <h4>Categories</h4>
                                    <ul class="list-unstyled fruite-categorie">
                                        <?php for($i=0; $i<$category_count_no; $i++){
                                            $category = $category_count->fetch_assoc();
                                        ?>
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="#"><i class="fas fa-apple-alt me-2"></i><?php echo ucfirst($category['category']) ?></a>
                                                <span>(<?php echo $category['count'] ?>)</span>
                                            </div>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="position-relative">
                                    <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                    <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                        <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                            <div class="col-lg-9">
                            Number or rows : <?php echo $rows; ?>
                            <div class="row g-4 justify-content-center">
                            <?php for($i=0; $i<$rows; $i++){ ?>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img" style="height: 200px;">
                                                <img src="<?php echo $data[$i]['image'] ?>" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <a href="shop-detail.php?product_id=<?php echo $data[$i]['id']; ?>">
                                                    <h4><?php echo $data[$i]['product_name'] ?></h4>
                                                    <p><?php echo $data[$i]['description'] ?></p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">Rs<?php echo $data[$i]['price'] ?> / kg</p>
                                                    </div>
                                                </a>
                                                <!-- <form class="addtocart">
                                                    <input type="hidden" value="<?php //echo $data[$i]['id'] ?>" name="product_id">
                                                    <button class="btn border border-secondary rounded-pill px-3 text-primary addtocart" type="submit">Add to cart</button>
                                                </form> -->
                                                <button class="btn border border-secondary rounded-pill px-3 text-primary addtocart" data="<?php echo $data[$i]['id'] ?>"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
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
        <!-- Fruits Shop End-->

        <!-- ajax for add to cart items -->

        <script>
            // document.querySelectorAll('.addtocart').forEach((form) => {
            //     form.addEventListener('click', (e) => {
            //         e.preventDefault();
            //         const formData = new FormData(form);
            //         let xhr = new XMLHttpRequest();
            //         xhr.open('POST', 'http://localhost/fruitables/addtocart.php', true);
            //         // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Set content type
            //         // xhr.setRequestHeader('Content-Type', 'application/json');

            //         xhr.onload = function() {
            //             if (xhr.status == 200) {
            //                 console.log(xhr.responseText); // Handle the response
            //             }
            //         };

            //         // Prepare the data to be sent
            //         // let data = 'product_id=' + productId;
            //         // let data = JSON.stringify({product_id : productId})
            //         xhr.send(formData); // Send the request with data
            //     });
            // });

            let alertMessageForSuccessAddtocart = document.querySelector('.alert-message-for-success-add-to-cart');

            document.querySelector('.close').addEventListener('click', ()=>{
                alertMessageForSuccessAddtocart.style.display = 'none';
            })

            const cart_count = document.querySelector('#cart_count');

            
            document.querySelectorAll('.addtocart').forEach((button) => {
                button.addEventListener('click', ()=>{
                    let product_id = button.getAttribute('data');
                    
                    // alert(product_id)
                    const xhr = new XMLHttpRequest();

                    xhr.open('post', 'http://localhost/fruitables/addtocart.php');
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    xhr.onload = function(){
                        if(xhr.status == 200){
                            // console.log(xhr.responseText);
                            let arr = JSON.parse(xhr.responseText);
                            arr.forEach((item) => {
                                console.log(item);
                            });
                            cart_count.innerText = arr.length;
                            alertMessageForSuccessAddtocart.style.display = 'block';
                        }
                    }
                    let data = "product_id="+encodeURIComponent(product_id);
                    xhr.send(data);
                })
            });


</script>


        <?php 

include "./footer.php";

?>