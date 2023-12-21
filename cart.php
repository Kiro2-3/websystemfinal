<?php

 session_start();

 include("connection.php");
 include("function.php");
 require 'config.php';
 $user_data = check_login($con);
 if (isset($_POST['pname'], $_POST['pimage'], $_POST['pcode'])) {
    $pname = $_POST['pname'];
    $pimage = $_POST['pimage'];
    $pcode = $_POST['pcode'];
} else {
    echo 'Some required fields are missing in the form submission.';
}
?>
<html>
<head>
	<title>CDMUOS</title>
    <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>
<body>
<style>
        
        :root {
    --white: #ffffffdc;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    outline: none;
    border: none;
    text-decoration: none;
    text-transform: capitalize;
    transition: .2s linear;
}

html {
    font-size: 62.5%;
    scroll-behavior: smooth;
    scroll-padding-top: 6rem;
    overflow-x: hidden;
}

section {
    padding: 14rem 9%;
}

.heading {
    text-align: center;
    font-size: 4rem;
    color: #003514;
    padding: 1rem;
    margin: 2rem 0;
    background: rgba(243, 0, 0, 0.05);
}

.heading span {
    color: #000000;
}

.btn {
    display: inline-block;
    margin-top: 1rem;
    border-radius: 5rem;
    background: #000000;
    color: #ffffff;
    padding: .9rem 3.5rem;
    cursor: pointer;
    font-size: 1.7rem;
}

.btn:hover {
    background: #003514;
}

.btn1 {
    display: inline-block;
    margin-top: 1rem;
    border-radius: 100rem;
    color: #EBEBEB;
    padding: .9rem 1.5rem;
    cursor: pointer;
    font-size: 10rem;
    left :80%;
    top: 18%;
    position: absolute;

}
.btn1:hover {
    color: #CBDA00;
}


header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: #003514;
    padding: 2rem 9%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    z-index: 1000;
    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
}

header .logo {
    font-size: 3rem;
    color: #ffffff;
    font-weight: bolder;
}

header .logo span {
    color: #ffc400;
}

header .navbar a {
    font-size: 2rem;
    padding: 0 1.5rem;
    color: #ffc400;
}

header .navbar a:hover {
    color: #ffc400;
}

.icon {
    width: 300px;   
    float: left;
    height: 70px;
}

/* Assuming these are your header icons */
header .icons a {
    font-size: 2rem;
    color: #fdfdfd;
    margin-left: 1rem; /* Adjust the margin as needed */
    display: inline-block; /* Ensure each icon is on the same line */
    vertical-align: middle; /* Align icons vertically in the middle */
}


header .icons a:hover {
    color: #D8D400;
}

header #toggler {
    display: none;
}

header.fa-bars {
    font-size: 3rem;
    color: #ffc400;
    border-radius: .5rem;
    padding: .5rem 1.5rem;
    cursor: pointer;
    border: .1rem solid rgba(0, 0, 0, 0.3);
    display: none;
}

.navbar {
    align-items: center;
    list-style: none;
    position: relative;
    padding: 12px 20px;
}

.logo img {
    width: 200px;
}

.menu {
    display: flex;
}

.menu li {
    padding-left: 30px;
}

.menu li a {
    display: inline-block;
    text-decoration: none;
    color: #FFFFFF;
    text-align: center;
    transition: 0.15s ease-in-out;
    position: relative;
    text-transform: uppercase;
}

.menu li a::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 1px;
    background-color: #FFF;
    transition: 0.15s ease-in-out;
}

.menu li a:hover:after {
    width: 100%;
}

.open-menu,
.close-menu {
    position: absolute;
    color: #FFFFFF;
    cursor: pointer;
    font-size: 1.5rem;
    display: none;
}

.open-menu {
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}

.close-menu {
    top: 20px;
    right: 20px;
}

#check {
    display: none;
}

@media(max-width: 977px) {
    .menu {
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 80%;
        height: 100vh;
        position: fixed;
        top: 0;
        right: -100%;
        z-index: 100;
        background-color: #55FF55;
        color: #FFF;
        transition: all 0.2s ease-in-out;
    }
    .menu li {
        margin-top: 40px;
    }
    .menu li a {
        padding: 10px;
    }
    .open-menu,
    .close-menu {
        display: block;
    }
    #check:checked~.menu {
        right: 0;
    }
}

.home {
    display: flex;
    align-items: center;
    min-height: 110vh;
    background: url(https://i.imgur.com/LxBPJ9e.jpg) no-repeat;
    background-position: center;
}
.inforpic{
    width: 48%;
    position: absolute;
    transform: translate(-24%,-50%);
    top: 50%;
    left: 50%;
    overflow: hidden;
    border: 5px solid #ffffff;
    border-radius: 8px;
    box-shadow: 10px 25px 30px rgba(30,30,200,0.3);
}
.inforpic1{
    width: 75%;
    display: flex;
    animation: slide 10s infinite;
    
}
@keyframes slide{
    0%{
        transform: translateX(0);
    }
    25%{
        transform: translateX(0);
    }
    30%{
        transform: translateX(-100%);
    }
    50%{
        transform: translateX(-100%);
    }
    55%{
        transform: translateX(-200%);
    }
    75%{
        transform: translateX(-200%);
    }
    80%{
        transform: translateX(-300%);
    }
    100%{
        transform: translateX(-300%);
    }
}



.home .content {
    max-width: 50rem;
}

.home .content h3 {
    font-size: 6rem;
    color: #FFE600;
}

.home .content span {
    font-size: 3.5rem;
    color: #055C26;
    padding: 1rem 0;
    line-height: 1.5;
}

.home .content p {
    font-size: 1.5rem;
    color: #003514;
    padding: 1rem 0;
    line-height: 1.5;
}

.about .row {
    display: flex;
    align-items: center;
    gap: 2rem;
    flex-wrap: wrap;
    padding: 2rem 0;
    padding-bottom: 3rem;
}

.about .row .video-container {
    flex: 1 1 40rem;
    position: relative;
}

.about .row .video-container video {
    width: 100%;
    border: 1.5rem solid #fff;
    border-radius: .5rem;
    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
    height: 100%;
    object-fit: cover;
}

.about .row .video-container h3 {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 3rem;
    background: #ffffff;
    width: 100%;
    padding: 1rem 2rem;
    text-align: center;
    mix-blend-mode: screen;
}

.about .row .content {
    flex: 1 1 40rem;
}

.about .row .content h3 {
    font-size: 3rem;
    color: #1f9900;
}

.about .row .content p {
    font-size: 1.5rem;
    color: #003514;
    padding: .5rem 0;
    padding-top: 1rem;
    line-height: 1.5;
}

.icons-container {
    background: #eee;
    display: flex;
    flex-wrap: wrap;
    gap:3rem;
    padding-top: 5rem;
    padding-bottom: 5rem;
}

.icons-container .icons {
    background: #fff;
    border: .1rem solid rgba(0, 0, 0, .1);
    padding: 2rem;
    display: flex;
    align-items: center;
    flex: 1 1 25rem;
}

.icons-container .icons img {
    height: 5rem;
    margin-right: 2rem;
}

.icons-container .icons h3 {
    color: #1f9900;
    padding-bottom: .5rem;
    font-size: 1.5rem;
}

.icons-container .icons span {
    color: #1f9900;
    font-size: 1.3rem;
}

.products .box-container {
    display: flex;
    flex-wrap: wrap;
    gap: 3.5rem;
}

.products .box-container .box {
    flex: 1 1 30rem;
    box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .1);
    border-radius: .5rem;
    border: .1rem solid rgba(0, 0, 0, .1);
    position: relative;
}

.products .box-container .box .discount {
    position: absolute;
    top: 1rem;
    left: 1rem;
    padding: .7rem 1rem;
    font-size: 2rem;
    color: #FFBB00;
    background: rgba(255, 51, 153, .05);
    z-index: 1;
    border-radius: .5rem;
}

.products .box-container .box .image {
    position: relative;
    text-align: center;
    padding-top: 2rem;
    overflow: hidden;
}

.products .box-container .box .image img {
    height: 25rem;
}

.products .box-container .box:hover .image img {
    transform: scale(2.1);
}

.products .box-container .box .image .icons {
    position: absolute;
    bottom: -7rem;
    left: 0;
    right: 0;
    display: flex;
}

.products .box-container .box:hover .image .icons {
    bottom: 0;
}

.products .box-container .box .image .icons a {
    height: 5rem;
    line-height: 5rem;
    font-size: 1rem;
    width: 50%;
    background: #003514;
    color: #fff;
}

.products .box-container .box .image .icons .cart-btn {
    border-left: .1rem solid #fff7;
    border-right: .1rem solid #fff7;
    width: 100%;
}

.products .box-container .box .image .icons a:hover {
    background: #333;
}

.products .box-container .box .content {
    padding: 2rem;
    text-align: center;
}

.products .box-container .box .content h3 {
    font-size: 2.5;
    color: #333;
}

.products .box-container .box .content .price {
    font-size: 2.5rem;
    color: #003514;
    font-weight: bolder;
    padding-top: 1rem;
}

.products .box-container .box .content .price span {
    font-size: 1.5rem;
    color: #999;
    font-weight: lighter;
    text-decoration: line-through;
}

.review .box-container {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
}

.review .box-container .box {
    flex: 1 1 30rem;
    box-shadow: 0.5rem 1.5rem rgba(0, 0, 0, .1);
    border-radius: .5rem;
    padding: 3rem 2rem;
    position: relative;
    border: 1rem solid rgba(0, 0, 0, .1);
}

.review .box-container .box .fa-quote-right {
    position: absolute;
    bottom: 3rem;
    right: 3rem;
    font-size: 6rem;
    color: #eee;
}

.review .box-container .box .stars i {
    color: #003514;
    font-size: 2rem;
}

.review .box-container .box p {
    color: #999;
    font-size: 1.5rem;
    line-height: 1.5;
    padding-top: 2rem;
}

.review .box-container .box .user {
    display: flex;
    align-items: center;
    padding-top: 2rem;
}

.review .box-container .box .user img {
    height: 6rem;
    width: 6rem;
    border-radius: 50%;
    object-fit: cover;
    margin: 1rem;
}

.review .box-container .box .user h3 {
    font-size: 2rem;
    color: #333;
}

.review .box-container .box .user span {
    font-size: 1.5rem;
    color: #999;
}

.contact .row {
    display: flex;
    flex-wrap: wrap-reverse;
    gap: 1.5rem;
    align-items: center;
}

.contact .row form {
    flex: 1 1 40rem;
    padding: 2rem 2.5rem;
    box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .1);
    border: 1rem solid rgba(0, 0, 0, .1);
    background: #fff;
    border-radius: .5rem;
}

.contact .row .image {
    flex: 1 1 40rem;
}

.contact .row .image img {
    width: 100%;
}

.contact .row form .box {
    padding: 1rem;
    font-size: 1.7rem;
    color: #333;
    text-transform: none;
    border: .1rem solid rgba(0, 0, 0, .1);
    border-radius: .5rem;
    margin: .7rem 0;
    width: 100%;
}

.contact .row form .box:focus {
    border-color: #003514;
}

.contact .row form textarea {
    height: 15rem;
    resize: none;
}

.footer .box-container {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
}

.footer .box-container .box {
    flex: 1 1 25rem;
}

.footer .box-container .box h3 {
    color: #333;
    font-size: 2.5rem;
    padding: 1rem 0;
}

.footer .box-container .box a {
    display: block;
    color: #666;
    font-size: 1.5rem;
    padding: 1rem 0;
}

.footer .box-container .box a:hover {
    color: #00500b;
    text-decoration: underline;
}

.footer .box-container .box img {
    margin-top: 1rem;
}

.footer .credit {
    text-align: center;
    padding: 1.5rem;
    margin: 1.5rem;
    padding-top: 2.5rem;
    font-size: 2rem;
    color: #333;
    border-top: .1rem solid rgba(0, 0, 0, .1);
}

.footer .credit span {
    color: #003514;
}

@media (max-width: 991px) {
    html {
        font-size: 55%;
    }
    header {
        padding: 2rem;
    }
    section {
        padding: 2rem;
    }
    .home {
        background-position: left;
    }
}

@media (max-width: 768px) {
    header .fa-bars {
        display: block;
    }
    header.navbar {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #eee;
        border-top: .1rem solid rgba(0, 0, 0, .1);
        clip-path: polygon(0 0, 100% 0, 100% 0, 0 0)
    }
    header #toggler:checked~.navbar {
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
    }
    header .navbar a {
        margin: 1.5rem;
        padding: 1.5rem;
        background: #fff;
        border: .1rem solid rgba(0, 0, 0, .1);
        display: block;
    }
    .home .content h3 {
        font-size: 5rem;
    }
    .home .content span {
        font-size: 2.5rem;
    }
    .icons-container .icons h3 {
        font-size: 2rem;
    }
    .icons-container .icons span {
        font-size: 1.7rem;
    }
}

@media (max-width: 450px) {
    html {
        font-size: 50%;
    }
    .heading {
        font-size: 3rem;
    }
}
  .card {
    height: 500px; /* Set the desired height for all cards */
  }

  .card-img-top {
    object-fit: cover; /* Ensure the image covers the entire card, maintaining aspect ratio */
    height: 60%; /* Set the desired height for the image */
    width: 100%; /* Ensure the image takes the full width of the card */
    margin-bottom: 10px; /* Add margin at the bottom for spacing */
  }
  .badge-danger {   
      font-size: 16px; /* Adjust the font size to your preference */
      padding: 0.25em 0.5em; /* Adjust the padding to control the badge size */
    }

    .fa-shopping-cart {
    font-size: 24px; /* Adjust the font size to your preference */
  }

  .trash-icon {
        font-size: 20px; /* Change the size as needed */
        margin-right: 5px; /* Adjust the right margin for positioning */
        /* Add other styles as needed */
    }
</style>

	<a href="logout.php"></a>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device, initial-scale=1.0">
    <title>fashion design</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>
    <header>

        <a class="logo">CDM<span>UOS</span></a>




        <div class="icons">
<a class="nav-link" href="cart.php "><i class="fas fa-shopping-cart"></i> <span id="cart-item"  class="badge badge-danger"></span></a>
<a class="nav-link" href="orderlist.php">
  <i class="fas fa-shopping-bag"></i>
</a>
<a class="nav-link" href="logout.php">
  <i class="fas fa-sign-out-alt"></i>
</a>
</div>



    </header>


                        
                <section class="products" id="products">
                    <div class="container">
                        <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                    echo $_SESSION['showAlert'];
                    } else {
                    echo 'none';
                    } unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><?php if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    } unset($_SESSION['showAlert']); ?></strong>
                            </div>
                            <div class="table-responsive mt-2">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                <tr>
                                    <td colspan="7">
                                    <h4 class="text-center text-info m-0">Products in your cart!</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>
                                    <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash "></i>&nbsp;&nbsp;Clear Cart</a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    require 'config.php';
                                    $stmt = $conn->prepare('SELECT * FROM cart');
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $grand_total = 0;
                                    while ($row = $result->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                                    <td><img src="<?= $row['product_image'] ?>" width="50"></td>
                                    <td><?= $row['product_name'] ?></td>
                                    <td>
                                    <i class="fas fa-peso-sign"></i>&nbsp;&nbsp;<?= number_format($row['product_price'],2); ?>
                                    </td>
                                    <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                                    <td>
                                    <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:90px, height:auto;">
                                    </td>
                                    <td><i class="fas fa-peso-sign"></i>&nbsp;&nbsp;<?= number_format($row['total_price'],2); ?></td>
                                    <td>
                                    <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash trash-icon"></i></i></a>
                                    </td>
                                </tr>
                                <?php $grand_total += $row['total_price']; ?>
                                <?php endwhile;
                                
                                ?>
                                <tr>
                                    <td colspan="3">
                                    <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                                        Shopping</a>
                                    </td>
                                    <td colspan="2"><b>Total</b></td>
                                    <td><b><i class="fas fa-peso-sign"></i>&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
                                    <td>
                                    <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                                    </td>
                                </tr>
                                
                                </tbody>
                            </table>
                            </div>
                        </div>
                        </div>
                    </div>
                    

                    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

                    <script type="text/javascript">
                    $(document).ready(function() {

                        // Change the item quantity
                        $(".itemQty").on('change', function() {
                        var $el = $(this).closest('tr');

                        var pid = $el.find(".pid").val();
                        var pprice = $el.find(".pprice").val();
                        var qty = $el.find(".itemQty").val();
                        location.reload(true);
                        $.ajax({
                            url: 'action.php',
                            method: 'post',
                            cache: false,
                            data: {
                            qty: qty,
                            pid: pid,
                            pprice: pprice
                            },
                            success: function(response) {
                            console.log(response);
                            }
                        });
                        });

                        // Load total no.of items added in the cart and display in the navbar
                        load_cart_item_number();

                        function load_cart_item_number() {
                        $.ajax({
                            url: 'action.php',
                            method: 'get',
                            data: {
                            cartItem: "cart_item"
                            },
                            success: function(response) {
                            $("#cart-item").html(response);
                            }
                        });
                        }
                    });
                    
                    </script>

                            </section>


                            <section class="footer">
                            <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
            <div class="box-container">

                <div class="box">
                    <h3>quick links</h3>
                    <a>home</a>
                    <a>about</a>
                    <a>products</a>
                    <a>review</a>
                    <a>contact</a>
                </div>

                <div class="box">
                    <h3>extra links</h3>
                    <a>my account</a>
                    <a>my order</a>
                    <a></a>
                </div>


                <div class="box">
                    <h3>contact info</h3>
                    <a>+63-928-7268-871</a>
                    <a>uniformcdm@gmail.com</a>
                    <a>Kasiglahan Rodriguez Rizal</a>
                    <img src=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="24" height="24" class="cc-visa-fwb" fill="#06579a"><path d="M470.1 231.3s7.6 37.2 9.3 45H446c3.3-8.9 16-43.5 16-43.5-.2.3 3.3-9.1 5.3-14.9l2.8 13.4zM576 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48zM152.5 331.2L215.7 176h-42.5l-39.3 106-4.3-21.5-14-71.4c-2.3-9.9-9.4-12.7-18.2-13.1H32.7l-.7 3.1c15.8 4 29.9 9.8 42.2 17.1l35.8 135h42.5zm94.4.2L272.1 176h-40.2l-25.1 155.4h40.1zm139.9-50.8c.2-17.7-10.6-31.2-33.7-42.3-14.1-7.1-22.7-11.9-22.7-19.2.2-6.6 7.3-13.4 23.1-13.4 13.1-.3 22.7 2.8 29.9 5.9l3.6 1.7 5.5-33.6c-7.9-3.1-20.5-6.6-36-6.6-39.7 0-67.6 21.2-67.8 51.4-.3 22.3 20 34.7 35.2 42.2 15.5 7.6 20.8 12.6 20.8 19.3-.2 10.4-12.6 15.2-24.1 15.2-16 0-24.6-2.5-37.7-8.3l-5.3-2.5-5.6 34.9c9.4 4.3 26.8 8.1 44.8 8.3 42.2.1 69.7-20.8 70-53zM528 331.4L495.6 176h-31.1c-9.6 0-16.9 2.8-21 12.9l-59.7 142.5H426s6.9-19.2 8.4-23.3H486c1.2 5.5 4.8 23.3 4.8 23.3H528z"></path></svg>
                    <img src=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="24" height="24" class="cc-paypal-fwb" fill="#06579a"><path d="M186.3 258.2c0 12.2-9.7 21.5-22 21.5-9.2 0-16-5.2-16-15 0-12.2 9.5-22 21.7-22 9.3 0 16.3 5.7 16.3 15.5zM80.5 209.7h-4.7c-1.5 0-3 1-3.2 2.7l-4.3 26.7 8.2-.3c11 0 19.5-1.5 21.5-14.2 2.3-13.4-6.2-14.9-17.5-14.9zm284 0H360c-1.8 0-3 1-3.2 2.7l-4.2 26.7 8-.3c13 0 22-3 22-18-.1-10.6-9.6-11.1-18.1-11.1zM576 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48zM128.3 215.4c0-21-16.2-28-34.7-28h-40c-2.5 0-5 2-5.2 4.7L32 294.2c-.3 2 1.2 4 3.2 4h19c2.7 0 5.2-2.9 5.5-5.7l4.5-26.6c1-7.2 13.2-4.7 18-4.7 28.6 0 46.1-17 46.1-45.8zm84.2 8.8h-19c-3.8 0-4 5.5-4.2 8.2-5.8-8.5-14.2-10-23.7-10-24.5 0-43.2 21.5-43.2 45.2 0 19.5 12.2 32.2 31.7 32.2 9 0 20.2-4.9 26.5-11.9-.5 1.5-1 4.7-1 6.2 0 2.3 1 4 3.2 4H200c2.7 0 5-2.9 5.5-5.7l10.2-64.3c.3-1.9-1.2-3.9-3.2-3.9zm40.5 97.9l63.7-92.6c.5-.5.5-1 .5-1.7 0-1.7-1.5-3.5-3.2-3.5h-19.2c-1.7 0-3.5 1-4.5 2.5l-26.5 39-11-37.5c-.8-2.2-3-4-5.5-4h-18.7c-1.7 0-3.2 1.8-3.2 3.5 0 1.2 19.5 56.8 21.2 62.1-2.7 3.8-20.5 28.6-20.5 31.6 0 1.8 1.5 3.2 3.2 3.2h19.2c1.8-.1 3.5-1.1 4.5-2.6zm159.3-106.7c0-21-16.2-28-34.7-28h-39.7c-2.7 0-5.2 2-5.5 4.7l-16.2 102c-.2 2 1.3 4 3.2 4h20.5c2 0 3.5-1.5 4-3.2l4.5-29c1-7.2 13.2-4.7 18-4.7 28.4 0 45.9-17 45.9-45.8zm84.2 8.8h-19c-3.8 0-4 5.5-4.3 8.2-5.5-8.5-14-10-23.7-10-24.5 0-43.2 21.5-43.2 45.2 0 19.5 12.2 32.2 31.7 32.2 9.3 0 20.5-4.9 26.5-11.9-.3 1.5-1 4.7-1 6.2 0 2.3 1 4 3.2 4H484c2.7 0 5-2.9 5.5-5.7l10.2-64.3c.3-1.9-1.2-3.9-3.2-3.9zm47.5-33.3c0-2-1.5-3.5-3.2-3.5h-18.5c-1.5 0-3 1.2-3.2 2.7l-16.2 104-.3.5c0 1.8 1.5 3.5 3.5 3.5h16.5c2.5 0 5-2.9 5.2-5.7L544 191.2v-.3zm-90 51.8c-12.2 0-21.7 9.7-21.7 22 0 9.7 7 15 16.2 15 12 0 21.7-9.2 21.7-21.5.1-9.8-6.9-15.5-16.2-15.5z"></path></svg>
                </div>
            </div>

            <div class="credit"> created by <span> BSIT 2-E </span> | all right reserved</div>
        </section>

</body>

</html>

</body>
</html>