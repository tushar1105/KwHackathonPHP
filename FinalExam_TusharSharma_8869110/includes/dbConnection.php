<?php
//session start
session_start();

// DB connection
$db = new mysqli("localhost","root","","kwhackathon");

// Check connection
if ($db -> connect_errno) {
  // echo "Failed to connect to MySQL: " . $db -> connect_error;
  exit();
}