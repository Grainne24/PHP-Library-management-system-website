<?php

    include('database.php');

    session_start();

    if (!isset($_SESSION["username"])) //if not logged in log out
    {
        header('Location: logout.php');
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve Book</title>
    <link rel="stylesheet" href="style.css">
    <script src="/script/javascript.js"></script>
</head>
<body>
    <nav>
        <ul>
            <li><a class="active" href="mainPage.php">Homepage</a></li>
            <li><a class="active" href="reservebook.php">Reserve book</a></li>
            <li><a class="active" href="reservedbooks.php">Show reserved book</a></li>
            <li><a class="active "href="search.php">Search book</a></li>
            <li><a class="active" href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <?php
        include ('header.php');

        if(isset($_POST['ISBN']))
        {
            $username = $_SESSION['username'];

            $isbn = mysqli_real_escape_string($conn, $_POST['ISBN']);

            $reserve = "SELECT Reserve FROM books WHERE ISBN = '$isbn'"; //select all the elements in reserve for ISBN that user picked

            $result = mysqli_query($conn, $reserve);
            $row = mysqli_fetch_assoc($result);
            $reservestat = $row['Reserve'];

            if($reservestat === 'N') //if the book hasnt been reserved 
            {
                $stmt = $conn->prepare("INSERT INTO reservations VALUES (?, ?, NOW())"); //insert new reservation into reservation database 
                $stmt->bind_param("ss", $isbn, $username);
                $stmt->execute();
    
                $update = "UPDATE books SET Reserve = 'Y' WHERE ISBN = '$isbn'"; //update book from N to Y - indicates its reserved 
    
                mysqli_query($conn, $update);

                header('Location: reservedbooks.php'); //go to page which display reserved books
                return;

            }

            else
            {
                $_SESSION['errors'] = 'Book is already reserved'; //if book reserved - send error message 
                header('Location: reservebook.php');
                return;
            }

        
        }
    ?>

    <form action="" method="POST" id="reserve">
        <h3>What book would you like to reserve?</h3>

        <?php
            if(isset($_SESSION['errors']))
            {
                echo('<p style="color:red">ERROR:'.$_SESSION['errors'].'</p>'); //error message
                unset($_SESSION['errors']); 
            }
        ?>
    
        <p>ISBN:
        <input type="text" name="ISBN" required>
        </p>

        <p><input type="submit" value="Reserve"/>
        </p>    
    
        <a href="logout.php">Logout</a>
        </form>


    <?php

        include ('footer.php');

    ?>

</body>
</html>
