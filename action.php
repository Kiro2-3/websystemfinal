<?php

require 'config.php';
require 'connection.php';
require 'function.php';
require 'vendor/autoload.php'; // Make sure this is the correct path to autoload.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
require 'config.php';

// Add products into the cart table
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pimage = $_POST['pimage'];
    $pcode = $_POST['pcode'];
    $pqty = isset($_POST['pqty']) ? max(1, intval($_POST['pqty'])) : 1; // Validate and ensure a minimum quantity of 1
    $total_price = $pprice * $pqty;

    $stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=?');
    $stmt->bind_param('s', $pcode);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $code = $r['product_code'] ?? '';

    if (!$code) {
        $query = $conn->prepare('INSERT INTO cart (product_name,product_price,product_image,qty,total_price,product_code) VALUES (?,?,?,?,?,?)');
        $query->bind_param('sssiss', $pname, $pprice, $pimage, $pqty, $total_price, $pcode);
        $query->execute();

        echo '<div class="alert alert-success alert-dismissible mt-2">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong>Item added to your cart!</strong>
                        </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible mt-2">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong>Item already added to your cart!</strong>
                        </div>';
    }
}

// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
    $stmt = $conn->prepare('SELECT * FROM cart');
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    echo $rows;
}

// Remove single items from cart
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];

    $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Item removed from the cart!';
    header('location:cart.php');
}

// Remove all items at once from cart
if (isset($_GET['clear'])) {
    $stmt = $conn->prepare('DELETE FROM cart');
    $stmt->execute();
    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'All Item removed from the cart!';
    header('location:cart.php');
}

// Set total price of the product in the cart table
if (isset($_POST['qty'])) {
    $qty = $_POST['qty'];
    $pid = $_POST['pid'];
    $pprice = $_POST['pprice'];

    $tprice = $qty * $pprice;

    $stmt = $conn->prepare("UPDATE cart SET qty=?, total_price=? WHERE id=?");
    if (!$stmt) {
        echo "Error in preparing the update statement: " . $conn->error;
    } else {
        $stmt->bind_param("isi", $qty, $tprice, $pid);
        if ($stmt->execute()) {
            echo "Quantity updated successfully!";
        } else {
            echo "Error updating quantity: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Checkout and save customer info in the orders table
if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
    $loggedInUserId = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $products = $_POST['products'];
    $grand_total = $_POST['grand_total'];
    $address = $_POST['address'];
    $pmode = $_POST['pmode'];
    $transaction_id = $_POST['transaction_id'];

    $data = '';

    // PHPMailer configuration and email sending
    $mail = new PHPMailer(true);
    $mail->isSMTP(); // Send using SMTP
    $mail->Host = 'smtp-relay.brevo.com'; // Set the SMTP server to send through
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'uniformcdm@gmail.com'; // SMTP username
    $mail->Password = 'y2QRI5A9YgkVz4r3'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    $mail->setFrom('uniformcdm@gmail.com', 'CMDUOS');
    $mail->addAddress($email, $name); // Add a recipient

    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Order Confirmation';

    $mail->Body = "Thank you for your order! Your total amount paid is $grand_total PHP. We will deliver the following items to your specified address: $address.\n\n";

	// Loop through each product in the order and append to the email body
	$productLines = explode(',', $products);
	foreach ($productLines as $productLine) {
    $productInfo = explode('-', $productLine);
    if (count($productInfo) == 3) {
        list($productName, $quantity, $price) = $productInfo;
        $mail->Body .= "\nProduct: $productName\nQuantity: $quantity\nPrice: $price\n";
    }
}

$mail->Body .= "\n\nThank you for shopping with us!";


    // Send email
    try {
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    $stmt = $conn->prepare('INSERT INTO orders (id,name,email,phone,address,pmode,products,amount_paid,transaction_id)VALUES(?,?,?,?,?,?,?,?,?)');
    $stmt->bind_param('issssssss', $loggedInUserId, $name, $email, $phone, $address, $pmode, $products, $grand_total,$transaction_id);
    $stmt->execute();
    $stmt2 = $conn->prepare('DELETE FROM cart');
    $stmt2->execute();

    $data .= '<div class="text-center">
                        <h1 class="display-4 mt-2 text-danger">Thank You!</h1>
                        <h2 class="text-success">Your Order Placed Successfully!</h2>
                        <h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
                        <h4>Your Name : ' . $name . '</h4>
                        <h4>Your E-mail : ' . $email . '</h4>
                        <h4>Your Phone : ' . $phone . '</h4>
                        <h4>Total Amount Paid : ' . number_format($grand_total, 2) . '</h4>
                        <h4>Payment Mode : ' . $pmode . '</h4>
                        <h4>Payment Mode : ' . $transaction_id . '</h4>
                  </div>';
    echo $data;
}



?>
