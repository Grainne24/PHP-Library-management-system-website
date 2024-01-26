<?php
    session_start();

    if (!isset($_SESSION["username"]))
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
    <link rel="stylesheet" href="style.css">
    <script src="errorcheckingNA.js"></script>
    <title>Document</title>
</head>
<body>
    <nav>
        <ul>
            <li><a class="active" href="mainPage.php">Homepage</a></li>
            <li><a class="active" href="reservebook.php">Reserve book</a></li>
            <li><a class="active" href="reservedbooks.php">Show reserved book</a></li>
            <li><a class="active" href="search.php">Search book</a></li>
            <li><a class="active" href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <?php
        include ('header.php');
    ?>

    <h1>Welcome back, <?php echo htmlspecialchars($_SESSION["username"]); ?> </h1>

    <button onclick= "window.location.href = 'reservebook.php';">Reserve a book</button>
    <br></br>
    <button onclick= "window.location.href = 'search.php';">Search for a book</button>
    <br></br>
    <button onclick= "window.location.href = 'reservedbooks.php';">Show reserved books</button>
    <br></br>
    <button onclick= "window.location.href = 'logout.php';">Logout</button>

    <?php
        include ('footer.php');
    ?>
</body>
</html>