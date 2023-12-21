<?php
require 'config.php';
require 'connection.php';
require 'function.php';

session_start();

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database
    $stmt = $conn->prepare("SELECT email FROM password_resets WHERE token = ? AND created_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        // Token is valid, show the password reset form
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
    transform: translate(-100%,40%);
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
    color: #FF1E00;
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
    gap: 1.5rem;
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
  

  .row mt-2 pb-3 {

    transform: translate(-100%,40%);
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

    <link rel="stylesheet" href="endrina.css">

    <link rel="stylesheet" href="endrina.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>
<header>

<a class="logo">CDM<span>UOS</span></a>



            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        </head>
        <body>
            <div class="container">
                <div class="table-responsive">
                    <h3 align="center">Reset Password</h3><br/>
                    <div class="box">
                        <form id="validate_form" method="post" action="reset_password_process.php">
                            <input type="hidden" name="token" value="<?php echo $token; ?>"/>
                            <div class="form-group">
                                <label for="pwd">New Password</label>
                                <input type="password" name="pwd" id="pwd" placeholder="Enter Password" required class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="cpwd">Confirm Password</label>
                                <input type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password" required class="form-control"/>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="reset_pwd" value="Reset Password" class="btn btn-success" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </body>
        </html>
<?php
    } else {
        echo 'Invalid or expired token.';
    }
} else {
    echo 'Token not provided.';
}
?>
