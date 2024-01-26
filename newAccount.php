<?php

    include('database.php'); //connection to database 

    if ( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmPassword']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['addressline1']) && isset($_POST['addressline2']) && isset($_POST['city']) && isset($_POST['telephone']) && isset($_POST['mobile']))
    {
        $n = $_POST['username']; //gets the inputs from the user from the form
        $p = sha1($_POST['password']); //sha1 function hashes all the passwords so even in the database nobody is able to view the password
        $cp = sha1($_POST['confirmPassword']); //sha1 is used again for the password checker, it uses the same hash code to check if they are the same
        $f = $_POST['firstname'];
        $l = $_POST['lastname']; 
        $ao = $_POST['addressline1'];
        $at = $_POST['addressline2'];
        $c = $_POST['city'];
        $t = $_POST['telephone'];
        $m = $_POST['mobile'];


        $query = "SELECT Username FROM Users WHERE username = '$n'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if (mysqli_num_rows($result) > 0) 
        {
            echo "<script>alert('Username already exists!')</script>";
        } 
        else 
        {
            if ($p == $cp) 
            {
                $sql = "INSERT INTO users (Username, Password, FirstName, LastName, AddressLine1, AddressLine2, City, Telephone, Mobile) VALUES ('$n', '$p', '$f', '$l', '$ao', '$at', '$c', '$t', '$m')";
    
                $query = mysqli_query($conn, $sql);
    
                if ($query) 
                {
                    $_SESSION['success'] = 'Succesful';
                    header("Location: currentAccount.php");
                    exit;
                } 
                else 
                {
                    echo "Failed to insert new data.";
                }
            } 
            
            else 
            {
                echo "<script>alert('Passwords do not match!')</script>";
            }
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="errorcheckingNA.js"></script>
</head>

<body>
    <?php
        include ('header.php');
    ?>

    <form action="./newAccount.php" method="POST" id="newUser">
    <h3>Sign up:</h3>

    <?php
        if(isset($_SESSION['success']))
        {
            echo('<p style="color:green">SUCCESS:'.$_SESSION['success'].'</p>');
            unset($_SESSION['success']);
        }
    ?>

    <p>Username:
    <input type="text" name="username" required>
    </p>

    <p>Password:
    <input type="password" name="password" id="pw" required>
    </p>

    <p>Confirm Password:
    <input type="password" name="confirmPassword" id="cp" required>
    </p>

    <p>First name:
    <input type="text" name="firstname" required>
    </p>

    <p>Last name:
    <input type="text" name="lastname" required>
    </p>

    <p>Address line 1:
    <input type="text" name="addressline1" required>
    </p>

    <p>Address line 2:
    <input type="text" name="addressline2">
    </p>

    <p>City:
    <input type="text" name="city" required>
    </p>

    <p>Telephone number: (+353)
    <input type="number" name="telephone">
    </p>
    
    <p>Mobile number: (+353)
    <input type="text" name="mobile" id="num" required>
    </p>

    <p><input type="submit" value="Register" onclick="return combine()"/>
    </p>

    <a href="currentAccount.php">Already have an account?</a>
    </form>

    <?php
        include ('footer.php');
    ?>


</body>
</html>

