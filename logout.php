<?php
session_save_path('/home2/kirbypar/public_html/arctc/sessions');
session_start();

ini_set('session.gc_max_lifetime', 0);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);

if(session_destroy()) // Destroying All Sessions
{
  header("Location: https://arctc.org/"); // Redirecting To Home Page
}
?>