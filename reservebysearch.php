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

        $reserve = "SELECT Reserve FROM books WHERE ISBN = '$isbn'";

        $result = mysqli_query($conn, $reserve);
        $row = mysqli_fetch_assoc($result);
        $reservestat = $row['Reserve'];

        if($reservestat === 'N')
        {
            $stmt = $conn->prepare("INSERT INTO reservations VALUES (?, ?, NOW())"); //insert data into reservation table in database
            $stmt->bind_param("ss", $isbn, $username);
            $stmt->execute();

            $update = "UPDATE books SET Reserve = 'Y' WHERE ISBN = '$isbn'"; //Changes the contents of reserve in books to show that the book has already been reserved 

            mysqli_query($conn, $update);

            header('Location: reservedbooks.php');
            return;

        }

        else
        {
            $_SESSION['errors'] = 'Book is already reserved';
            header('Location: reservebook.php');
            return;
        }

    }

    else
    {
        echo "error" . mysqli_error($conn);
    }

?>