<?php 
session_start();

include("connection.php");
include("function.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //something was posted
    $user_name = $_POST['user_name'];
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    if(!empty($user_name) && !empty($password) && !empty($email) && !is_numeric($user_name))
    {
        if(usernameExists($user_name)) {
            echo "Username already exists!";
        } else {
            //save to database
            if (!isset($_SESSION['last_user_id'])) {
                $_SESSION['last_user_id'] = 0;
            }
            
            $user_id = $_SESSION['last_user_id'] + 1;
            $_SESSION['last_user_id'] = $user_id;
            $query = "INSERT INTO users (user_id, email, user_name, password) VALUES ('$user_id', '$email', '$user_name', '$password')";

            mysqli_query($con, $query);

            header("Location: login.php");
            exit; 
        }
    }else
    {
        echo "Please enter some valid information!";
    }
}
?>


<!DOCTYPE html>
<html>

<head>

    <title>Sign up page</title>
    </head>
    <body>

    <style type="text/css">

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}


body {
  margin: 0;
  padding: 0;
  background: url(https://i.imgur.com/tjVSVHG.gif) no-repeat;
  background-size: cover;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
  --border-color: yellow; /* Define a CSS variable for border color */
    border-top: 20px solid var(--border-color); /* Add border to the top */
    border-bottom: 20px solid var(--border-color); /* Add border to the bottom */
}

body {
  --border-color: #FFC74FFB; /* Customizable color (orange in this case) */
}
.error-box {
            background-color: #f2dede;
            color: #a94442;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ebccd1;
            border-radius: 4px;
        }

.center {
    position: absolute;
            top: 50%; /* Adjust the vertical position */  
            left: 15%; /* Adjust the horizontal position */
            transform: translate(85%, -50%);
  width: 340px;
  background: white;
  border-radius: 10px;
  box-shadow: 10px 10px 15px rgba(0, 0.3, 0.3, 0.3);
  background: rgba(255,255,255,1);
-webkit-backdrop-filter: blur(50px);
backdrop-filter: blur(50px);
border: 1px solid rgba(255,255,255,0.5);
}

.center h1 {
  text-align: center;
  color: #007222;
  padding: 15px 0;
  border-bottom: 1px solid silver;
}

.center form {
  padding: 0 40px;
  box-sizing: border-box;
}

form .txt_field {
  position: relative;
  margin: 30px 0;
}

.txt_field input {
  width: 100%; 
  padding: 0 5px;
  height: 40px;
  font-size: 16px;
  border: none;
  background: none;
  outline: none;
  border-bottom: 2px solid #adadad;
}

.txt_field label {
  position: absolute;
  top: 50%;
  left: 5px;
  color: #adadad;
  transform: translateY(-50%);
  font-size: 16px;
  pointer-events: none;
  transition: .5s;
}

.txt_field span::before {
  content: '';
  position: absolute;
  top: 40px;
  left: 0;
  width: 0%;
  height: 2px;
  background: #00FF40;
  transition: .5s;
}

.txt_field input:focus ~ label,
.txt_field input:valid ~ label {
  top: -5px;
  color: #00FF40;
}

.txt_field input:focus ~ span::before,
.txt_field input:valid ~ span::before {
  width: 100%;
}

.pass {
  margin: -5px 0 20px 5px;
  color: #a6a6a6;
  cursor: pointer;
}

.pass:hover {
  text-decoration: underline;
}

input[type="submit"] {
  width: 100%;
  height: 50px;
  border: 1px solid;
  background: #F1C93B;
  border-radius: 25px;
  font-size: 18px;
  color: #646464;
  font-weight: 700;
  cursor: pointer;
  outline: none;
}

input[type="submit"]:hover {
  border-color: #00FF40;
  transition: .5s;
}

.signup_link {
  margin: 30px 0;
  text-align: center;
  font-size: 16px;
  color: #666666;
}

.signup_link a {
  color: #00B12C;
  text-decoration: none;
}

.signup_link a:hover {
  text-decoration: underline;
}
.inforpic {
    width: 38%;
    position: absolute;
    transform: translate(12%, -50%);
    top: 50%;
    left: 50%;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 10px 25px 30px rgba(30, 30, 100, 0.3);
    border: 1px solid rgba(255,255,255,0.45);
}

.inforpic1 {
    width: 74%;
    display: flex;
    animation: slide 20s infinite linear;

}

@keyframes slide {
    0%, 100% {
        transform: translateX(0);
    }

    30%{
        transform: translateX(-100%);
    }

    40%{
        transform: translateX(-200%);
    }

    70%{
        transform: translateX(-300%);
    }

    80% {
        transform: translateX(-200%);
    }
    90%{
        transform: translateX(-100%);
    }

}


 

img{
    width: 90%;
}
.logocdm {
  width: 50%;
  height: auto; /* Set height to auto for proportional scaling */
  margin-bottom: 5%;
}

.logo {
  display: flex;
  position: absolute;
  top: 18%;
  left: 20%;
  transform: translate(-50%, -50%); /* Center the image */
}

@media (max-width: 768px) {
    .inforpic {
        width: 80%;
        transform: translate(-40%, -50%);
    }

    .inforpic1 {
        width: 100%;
    }
}
</style>




<div class="inforpic">
  <div class="inforpic1">
    <img src="pic1.jpg" alt="cdmordernow" class="active">
    <img src="pic2.jpg" alt="cdmordernow1"class="active">
    <img src="pic3.jpg" alt="cdmordernow2"class="active">
    <img src="pic4.jpg" alt="cdmordernow" class="active">
    <img src="pic2.jpg" alt="cdmordernow" class="active">

</div>
</div>
    <div class="center">

        <h1>Sign Up</h1>
        <form method="post" id="signupForm">
        <div class="txt_field">
                <input type="name" name="firstname" required>
                <span></span>
                <label>First Name</label>
            </div>
            <div class="txt_field">
                <input type="name" name="Midname" required>
                <span></span>
                <label>Middle name</label>
            </div>
            <div class="txt_field">
                <input type="name" name="Surname" required>
                <span></span>
                <label>Last name</label>
            </div>
            <div class="txt_field">
                <input type="text" name="user_name" required>
                <span></span>
                <label>User name</label>
            </div>
            <div class="txt_field">
                <input type="email" name="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
            <input type="password" name="password" id="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="txt_field">
            <input type="password" name="confirmPassword" id="confirmPassword1" required>
    <span></span>
    <label for="confirmPassword">Confirm Password:</label>
            </div>

            <div class="signup_link">
                <input id="button" type="submit" value="Submit"><br><br>
                <a href="login.php">Log-In!</a><br><br>
            </div>
        </form>
    </div>



    <script>


document.addEventListener("DOMContentLoaded", function () {

    var form = document.getElementById("signupForm");

    if (form) {
        form.addEventListener("submit", function (event) {
            var password = form.elements["password"].value;
            var confirmPassword = form.elements["confirmPassword1"].value;


          
            if (password !== confirmPassword) {
              
                alert("Password do not match!");
                event.preventDefault();
            }
        });
    } else {
        console.error("Form with ID 'signupForm' not found");
    }
});


</script>
</body>

</html>
