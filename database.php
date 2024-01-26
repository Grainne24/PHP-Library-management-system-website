<?php

    $host = "localhost"; 
    $username = "root";
    $password = "";
    $database = "caassignment";

    $conn = mysqli_connect($host, $username, $password, $database); //connects to database caassignment
    
    if ($conn->connect_error) //if failed, kill connection
    {
        die("Connection failed: " . $conn->connect_error);
    }
?>