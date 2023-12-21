<!DOCTYPE html>
<html lang="en">
<head>  
    <title>Password Reset</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
</head>
<style>
 .box {
  width:100%;
  max-width:600px;
  background-color:#f9f9f9;
  border:1px solid #ccc;
  border-radius:5px;
  padding:16px;
  margin:0 auto;
 }
 input.parsley-success,
 select.parsley-success,
 textarea.parsley-success {
   color: #468847;
   background-color: #DFF0D8;
   border: 1px solid #D6E9C6;
 }

 input.parsley-error,
 select.parsley-error,
 textarea.parsley-error {
   color: #B94A48;
   background-color: #F2DEDE;
   border: 1px solid #EED3D7;
 }

 .parsley-errors-list {
   margin: 2px 0 3px;
   padding: 0;
   list-style-type: none;
   font-size: 0.9em;
   line-height: 0.9em;
   opacity: 0;

   transition: all .3s ease-in;
   -o-transition: all .3s ease-in;
   -moz-transition: all .3s ease-in;
   -webkit-transition: all .3s ease-in;
 }

 .parsley-errors-list.filled {
   opacity: 1;
 }
 
 .parsley-type, .parsley-required, .parsley-equalto {
  color:#ff0000;
 }
 .error {
  color: red;
  font-weight: 700;
 } 
</style>
<body>
<?php
require 'config.php';
require 'connection.php';
require 'function.php';

session_start();

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the users table
    $stmt = $conn->prepare("SELECT email FROM users WHERE reset_token = ? AND reset_expiration > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        // Token is valid, show the password reset form
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Password Reset</title>
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

</body>
</html>
