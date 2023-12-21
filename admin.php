<?php
session_start();

include("connection.php");
include("function.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // something was posted
    $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // read from database
        $query = "select * from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: adminOrderList.php"); 
                    die;
                }
            }
        }

        error_log("Passwords do not match!");
    } else {
        echo "Wrong username or password!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>ADMIN ACCESS ONLY</title>
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
            --border-color: yellow;
            border-top: 20px solid var(--border-color);
            border-bottom: 20px solid var(--border-color);
        }

        body {
            --border-color: #FFC74FFB;
        }

        .center {
            position: absolute;
            top: 50%;
            left: 15%;
            transform: translate(85%, -50%);
            width: 340px;
            background: white;
            border-radius: 10px;
            box-shadow: 10px 10px 15px rgba(0, 0.3, 0.3, 0.3);
            background: rgba(255, 255, 255, 1);
            -webkit-backdrop-filter: blur(50px);
            backdrop-filter: blur(50px);
            border: 1px solid rgba(255, 255, 255, 0.5);
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

        .txt_field input:focus~label,
        .txt_field input:valid~label {
            top: -5px;
            color: #00FF40;
        }

        .txt_field input:focus~span::before,
        .txt_field input:valid~span::before {
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
            border: 1px solid rgba(255, 255, 255, 0.45);
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

            30% {
                transform: translateX(-100%);
            }

            40% {
                transform: translateX(-200%);
            }

            70% {
                transform: translateX(-300%);
            }

            80% {
                transform: translateX(-200%);
            }
            90% {
                transform: translateX(-100%);
            }
        }

        img {
            width: 90%;
        }

        .logocdm {
            width: 50%;
            height: auto;
            margin-bottom: 5%;
        }

        .logo {
            display: flex;
            position: absolute;
            top: 18%;
            left: 20%;
            transform: translate(-50%, -50%);
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

        .loader-wrapper {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loader-wrapper p {
            margin-top: 20px;
            font-size: 1.2em;
        }

        #login-form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

<div class="inforpic">
    <!-- Your existing content here -->
</div>

<div class="center">
    <h1>ADMIN ACCESS ONLY</h1>
    <form method="post" id="loginForm">
        <div class="txt_field">
            <input type="text" name="user_name" required>
            <span></span>
            <label>ADMIN USERNAME</label>
        </div>
        <div class="txt_field">
            <input type="password" name="password" required>
            <span></span>
            <label>ADMIN PASSWORD</label>
        </div>

        <div class="pass"><a href="forgot.php" class="pass"></div>

        <div class="signup_link">
            <input id="button" type="submit" value="Log in"><br><br>
        </div>
    </form>
</div>

</body>

</html>
