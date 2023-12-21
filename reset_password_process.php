<?php
require 'config.php';
require 'connection.php';
require 'function.php';

session_start();

if (isset($_POST['reset_pwd'])) {
    $token = $_POST['token'];
    $password = $_POST['pwd'];
    $confirm_password = $_POST['cpwd'];

    if ($password === $confirm_password) {
        // Update the user's password in the database
        $stmt = $conn->prepare("SELECT email FROM password_resets WHERE token = ? AND created_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($result->num_rows > 0) {
            $email = $row['email'];
            
            $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update_stmt->bind_param("ss", $password, $email);
            $update_stmt->execute();
            $update_stmt->close();

            // Delete the used token from the password_resets table
            $delete_stmt = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
            $delete_stmt->bind_param("s", $token);
            $delete_stmt->execute();
            $delete_stmt->close();

            // Display success message with a link to login
            echo '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Password Updated</title>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
                    <style>
                        .container {
                            width: 100%;
                            max-width: 600px;
                            background-color: #f9f9f9;
                            border: 1px solid #ccc;
                            border-radius: 5px;
                            padding: 16px;
                            margin: 0 auto;
                            margin-top: 50px;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h3>Password updated successfully.</h3>
                        <p><a href="login.php">Click here</a> to login.</p>
                    </div>
                </body>
                </html>
            ';
        } else {
            // Display invalid or expired token message
            echo '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Invalid Token</title>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
                    <style>
                        .container {
                            width: 100%;
                            max-width: 600px;
                            background-color: #f9f9f9;
                            border: 1px solid #ccc;
                            border-radius: 5px;
                            padding: 16px;
                            margin: 0 auto;
                            margin-top: 50px;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <p>Invalid or expired token.</p>
                    </div>
                </body>
                </html>
            ';
        }
    } else {
        // Passwords don't match, provide a message and a link to go back to the login page
        echo '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Password Mismatch</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
                <style>
                    .container {
                        width: 100%;
                        max-width: 600px;
                        background-color: #f9f9f9;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        padding: 16px;
                        margin: 0 auto;
                        margin-top: 50px;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <p>Password and Confirm Password do not match. <a href="login.php">Go back to login</a></p>
                </div>
            </body>
            </html>
        ';
    }
} else {
    // Invalid request message
    echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Invalid Request</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
            <style>
                .container {
                    width: 100%;
                    max-width: 600px;
                    background-color: #f9f9f9;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    padding: 16px;
                    margin: 0 auto;
                    margin-top: 50px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <p>Invalid request.</p>
            </div>
        </body>
        </html>
    ';
}
?>
