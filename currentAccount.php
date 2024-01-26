<?php

    include('database.php');

    
    if(empty($_SESSION))
    {
        session_start();
    }

    if (isset($_POST['username']) && isset($_POST['password']))
    {
        $n = $_POST['username'];
        $p = sha1($_POST['password']); //sha1 function hashes all the passwords so even in the database nobody is able to view the password

        $query = "SELECT * FROM users where Username = '$n' and Password = '$p'"; //selects all the usernames and passwords which are in the database and match the POST from the form

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $row = mysqli_num_rows($result);

        if ($row == 1)
        {
            $_SESSION['username'] = $n; //if the username and password is the same as the username and password in the data base the its logged in
            $_SESSION['password'] = $p;
            $_SESSION['success'] = 'Logged in';
            header('Location: mainPage.php');
            return;
            
        }

        else
        {
            $_SESSION['error'] = 'Username or Password entered incorrectly'; //error message if password or username dont match the database one
            header('Location: currentAccount.php');
            return;
        }

    }

    $conn->close();



?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <script src="/script/javascript.js"></script>
</head>
<body>
    <?php
        include ('header.php');
    ?>

    <form action="./currentAccount.php" method="POST" id="currentUser">
        <h3>Login:</h3>

        <?php
            if(isset($_SESSION['error']))
            {
                echo('<p style="color:red">ERROR:'.$_SESSION['error'].'</p>'); //error message
                unset($_SESSION['error']);
            }
        ?>
    
        <p>Username:
        <input type="text" name="username" required>
        </p>
    
        <p>Password:
        <input type="password" name="password" required>
        </p>

        <p><input type="submit" value="Login"/>
        </p>    
    
        <a href="newAccount.php">Register now!</a>
        </form>

    <?php
        include ('footer.php');
    ?>
    
</body>
</html>