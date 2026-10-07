<?php
include_once 'GENERALFunctions.php';
session_save_path('/home2/kirbypar/public_html/arctc/sessions');
ini_set('session.gc_probability', 1);
session_start();// Starting Session


$error=''; // Variable To Store Error Message

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = connectDB("kirbypar_arctc_contacts");

// Storing Session
$user_check=$_SESSION['login_user'];

// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($connection, "select * from arctc_user_creds where ARCTC_Username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['ARCTC_Username'];
$login_user_role = $row['ARCTC_User_Role'];

if(!isset($login_session)){
	print 'NOT SET';
  closeDB($connection); // Closing Connection
  header('Location: index.php'); // Redirecting To Home Page
}




?>