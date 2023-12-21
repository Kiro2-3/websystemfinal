<?php

function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;

}

function check1_login($con) {
    if (isset($_SESSION['user_id'])) {
        // Fetch and return user data from the database
        // Replace this with your actual database query
        $user_id = $_SESSION['user_id'];
        $result = mysqli_query($con, "SELECT * FROM users WHERE id = $user_id");
        $user_data = mysqli_fetch_assoc($result);
        return $user_data;
    } else {
        // User is not logged in
        return null;
    }
}


function usernameExists($user_name) {
    global $con;

    $query = "SELECT * FROM users WHERE user_name = '$user_name'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}