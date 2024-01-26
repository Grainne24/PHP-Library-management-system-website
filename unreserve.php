<?php

    include('database.php');

    session_start();

    if (!isset($_SESSION["username"]))
    {
        header('Location: logout.php');
        exit;
    }


    if (isset($_SESSION['username']) && isset($_GET['ISBN'])) //on click of unreserve in reservedbooks section 
    {
        $username = $_SESSION['username'];
        $isbn = $_GET['ISBN'];

        $sql = "UPDATE books SET Reserve = 'N' WHERE ISBN = '$isbn'"; //update the books section from reserved (Y) to unreserved (N)
        $reserveup = mysqli_query($conn, $sql); 

        if ($reserveup) //if the $sql executed properly
        {
            $sql1 = "DELETE FROM reservations WHERE ISBN = '$isbn'"; //delete the reservation from the reservations page
            $reservedel = mysqli_query($conn, $sql1); 

            
            if($reservedel) //if it worked
            {
                header('Location: reservedbooks.php'); //show the updated page of reserved books
            }

        }
    }

    else
    {
        echo "error" . mysqli_error($conn);
    }


?>

