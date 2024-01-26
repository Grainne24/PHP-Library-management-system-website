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
    <?php
        include ('header.php');
    ?>

    <h1>Welcome to library website</h1>
    <button onclick= "window.location.href = 'currentAccount.php';">Login</button>
    <br></br>
    <button onclick= "window.location.href = 'newAccount.php';">Register</button>

    <?php
        include ('footer.php');
    ?>


</body>
</html>