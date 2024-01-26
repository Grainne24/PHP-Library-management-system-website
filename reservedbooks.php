<?php

    include('database.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserved Books</title>
    <link rel="stylesheet" href="style.css">
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

    include ('footer.php');

?>
    
</body>
</html>

<?php

    session_start();

    if (!isset($_SESSION["username"])) //logout if not logged in
    {
        header('Location: logout.php');
        exit;
    }


    $username = $_SESSION['username'];

    $stmt = $conn->prepare("SELECT * FROM reservations WHERE Username = ?"); //show all books from the reservations page which a certain user reserved
    $stmt->bind_param("s", $username); //replaces the ? in the $stmt to be the value $username
    $stmt->execute(); //executes the sql statement
    $result = $stmt->get_result(); 

    if($result->num_rows > 0) //if its not empty, lists all reserved books
    {
        echo"<h1>List of all reserved books:</h1>";
        echo "<div style='text-allign: center; '>";
        echo "<br></br>";
        echo "<br></br>";
        echo "<table style='margin: 0 auto;'>";
        echo "<table border='2'>";
        echo "<thead><tr><th>ISBN</th><th>ReservedDate</th><th>Unreserve</th></tr></thead>";
        echo "<tbody>";

        while($row = $result->fetch_assoc()) //fetch results and print them
        {
            echo "<tr>";
            echo "<td>{$row['ISBN']}</td>";
            echo "<td>{$row['ReservedDate']}</td>";
            echo "<td><a href='unreserve.php?ISBN={$row['ISBN']}'>Unreserve</a></td>"; //unreserve button
            echo "</tr>";
        }
        
    }

    else
    {
        echo "<h1>Sorry you have not reserved any books!</h1>"; //else no books reserved
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";

?>