<?php
include('includes/dbConnection.php');
session_start();
session_destroy();
$db->close();
header('Location: login.php');
