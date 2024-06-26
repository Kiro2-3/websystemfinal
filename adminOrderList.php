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
    <link rel="stylesheet" href="styles.css"> <!-- Include your custom styles if needed -->
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
            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </header>

    <section class="products" id="products">
        <h1 class="heading"> ADMIN <span> PANEL CONTROL</span></h1>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11">
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

                    <div class="mt-2">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Order ID</th>
                                <th>Address</th>
                                <th>Product</th>
                                <th>Date/Military</th>
                                <th>Payment Method</th>
                                <th>Amount</th>
                                <th>Amount paid</th>
                                <th>Order Status</th>
                                <th>Actions</th>
                                <th>Transaction ID (GCASH)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $loggedInUserId = $_SESSION['user_id'];
                            require 'config.php';
                            $stmt = $conn->prepare('SELECT * from orders');
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $grand_total = 0;
                            while ($row = $result->fetch_assoc()):
                            ?>
                                <tr>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['order_id'] ?></td>
                                    <td><?= $row['address'] ?></td>
                                    <td><?= $row['products'] ?></td>
                                    <td><?= $row['date'] ?></td>
                                    <td><?= $row['pmode'] ?></td>
                                    <td><?= $row['amount_paid'] ?></td>
                                    
                                    <td>
                                        <i class="fas fa-peso-sign"></i>&nbsp;&nbsp;<?= number_format($row['amount_paid'], 2); ?>
                                    </td>
                                    
                                    <td><?= $row['order_status'] ?></td>
                                    

                                    <td>
                                        
                <button class="btn btn-sm btn-primary change-status-btn" data-order-id="<?= $row['order_id'] ?>">Change Status</button>
                <button class="btn btn-sm btn-danger delete-order-btn" data-order-id="<?= $row['order_id'] ?>">Delete</button>
                <td><?= $row['transaction_id'] ?></td>
            </td>
            <input type="hidden" class="pprice" value="<?= $row['amount_paid'] ?>">
            
        </tr>
    <?php endwhile; ?>
</tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for changing order status -->
    <div class="modal fade" id="newStatusModal" tabindex="-1" role="dialog" aria-labelledby="newStatusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newStatusModalLabel">Change Order Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="orderStatusSelect">Select New Status:</label>
                    <select class="form-control" id="orderStatusSelect">
                        <option value="Preparing">Preparing</option>
                        <option value="In transit">In transit</option>
                        <option value="Out for delivery">Out for delivery</option>
                        <option value="Received">Received</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnChangeStatus">Change Status</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>

    <script>
        $(document).ready(function () {

    $(".change-status-btn").on("click", function () {
        var clickedButton = $(this);
        var orderId = clickedButton.data("order-id");
        var newStatusModal = $("#newStatusModal");
        newStatusModal.modal("show");


        $("#btnChangeStatus").off("click").on("click", function () {
   
            var newStatus = $("#orderStatusSelect").val();


            if (newStatus !== "") {
   
                $.ajax({
                    url: "updateOrderStatus.php",
                    method: "POST",
                    data: { orderId: orderId, newStatus: newStatus },
                    dataType: "json", 
                    success: function (response) {
                        console.log("Response from server:", response);

              
                        if (response.success) {
                    
                            var statusElement = clickedButton.closest("tr").find(".order-status");
                            console.log("Old status:", statusElement.text());
                            statusElement.text(newStatus);
                            console.log("New status:", statusElement.text());
                            newStatusModal.modal("hide");
                            alert("Order status updated successfully!");
                        } else {
                            alert("Failed to update order status. Please try again.");
                        }
                    },
                    error: function () {
                        alert("Update successfully.");
                        location.reload(true);
                    }
                });
            } else {
                alert("Please select a new order status.");
            }
        });
    });

    newStatusModal.on("hidden.bs.modal", function () {
        $("#btnChangeStatus").off("click");
    });
});

    $(document).ready(function () {
        $(".delete-order-btn").on("click", function () {
            var clickedButton = $(this);
            var orderId = clickedButton.data("order-id");

            // Display a confirmation dialog before deleting the order
            var confirmDelete = confirm("Are you sure you want to delete this order?");
            if (!confirmDelete) {
                return;
            }

            $.ajax({
                url: "deleteOrder.php",
                method: "POST",
                data: { orderId: orderId },
                dataType: "json",
                success: function (response) {
                    console.log("Response from server:", response);

                    if (response.success) {
                        // Remove the row from the table
                        clickedButton.closest("tr").remove();
                        alert("Order deleted successfully!");
                    } else {
                        alert("Failed to delete the order. Please try again.");
                    }
                },
                error: function () {
                    alert("Error deleting the order. Please try again.");
                }
            });
        });
    });

    </script>
</body>

</html>