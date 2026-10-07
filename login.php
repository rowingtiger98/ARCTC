<?php
include_once 'GENERALFunctions.php';
session_save_path('/home2/kirbypar/public_html/arctc/sessions');
ini_set('session.gc_probability', 1);
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
  if (empty($_POST['username']) || empty($_POST['password'])) {
    $error = "ERROR 1 Username or Password is invalid";
  }
  else
  {
    // Define $username and $password
    $username=$_POST['username'];
    $password=$_POST['password'];

    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    $connection = connectDB("kirbypar_arctc_contacts");

    // To protect MySQL injection for Security purpose
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = $connection->real_escape_string($username);
    $password = $connection->real_escape_string($password);

    // SQL query to fetch information of registerd users and finds user match.
	$query = sprintf('SELECT * FROM `arctc_user_creds` WHERE ARCTC_Password=\'%s\' AND ARCTC_Username=\'%s\'', $password, $username);
	$result = mysqli_query($connection, $query);
	$rows = mysqli_num_rows($result);
    if ($rows == 1) {
      $_SESSION['login_user']=$username; // Initializing Session
      header("location: account.php"); // Redirecting To Other Page
    } else {
      $error = "ERROR 2 Username or Password is invalid";
    }
    closeDB($connection); // Closing Connection
  }
}
?>