<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search book</title>
</head>
<body>
<?php
    $host = "localhost"; 
    $username = "root";
    $password = "";
    $database = "caassignment";

    $conn = mysqli_connect($host, $username, $password, $database);

    if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    }

    

    /*if (!isset($_SESSION['username']))
    {
        header('Location: currentAccount.php');
        exit;
    }*/

    /*session_start();

    $categories = array();
    $sql = "SELECT * FROM category";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        while($category = $result->fetch_assoc())
        {
            $categories[$category['CategoryID']] = $category['CategoryDepartment'];
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search book</title>
    <link rel="stylesheet" href="style.css">
    <script src="/script/javascript.js"></script>
</head>
<body>
    <nav>
        <ul>
            <li><a class="active" href="mainPage.php">Homepage</a></li>
            <li><a class="active" href="reservebook.php">Reserve book</a></li>
            <li><a href="searchbook.php">Search book</a></li>
        </ul>
    </nav>

    <?php
        include ('header.php');
    ?>

    <form action="./searchbook.php" method="POST" id="search">
        <h3>Search books:</h3>
    
        <p>Book Title:
        <input type="text" id="book" name="book">
        </p>

        <p>Author:
        <input type="text" id="author" name="author">
        </p>

        <label for ="category">Category</label>
        <select id="cat" name="Category">
            <option value="">Select a Category</option>
            <?php
                foreach ($categories as $catID => $catName)
                {
                    echo "<option value=".$catID.">$catName</option>";
                }
            ?>
        </select>


        <p>
        <input type="submit" name="search" value="search"/>
        </p>    
    
        <a href="currentAccount.php">Logout</a>
        </form>
    


    <?php

    if (isset($_POST['search']))
    {
        $bt = $_POST['book'];
        $a = $_POST['author'];
        $c = $_POST['Category'];

        $sql ="SELECT * FROM books WHERE BookTitle LIKE ? AND Author LIKE ?";
        $parameter = ["%$bt%", "%$a%"];

        if (!empty($c)) //if cat is empty this statement will evalute to true 
        {
            $sql .= " AND Category = ?"; //.= means that the SQL statement concatenates with this SQL statement
            $parameter[] = $c;
        }

        $result = $conn->query($sql);
        $books = array();
        $count = 0;

        if ($result->num_rows > 0)
        {
            while($book = $results->fetch_assoc())
            {
                $books[$count++]=$book;
            }
        }

        else
        {
            echo "No results.";
        }

        if (count ($books) > 0)
        {
            $items_per_page = 5;
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $start_index = ($page - 1) * $items_per_page;
        
            // Get the number of books in the array
            $num_books = count($books);
        
            // Get the current 5 books to display
            $current_books = array_slice($books, $start_index, $items_per_page);
        
            // Display the table
            echo "<table>";
            echo "<thead><tr><th>Title</th><th>Author</th><th>Edition</th><th>Year</th><th>Select</th></tr></thead>";
            echo "<tfoot><tr><td colspan='4'>Total Number of Books: {$num_books}</td></tr></tfoot>";
            echo "<tbody>";

            foreach ($current_books as $books) 
            {
                echo "<tr>";
                echo "<td>{$books['BookTitle']}</td>";
                echo "<td>{$books['Author']}</td>";
                echo "<td>{$books['Edition']}</td>";
                echo "<td>{$books['Year']}</td>";
                echo "<td><input type='checkbox' name='books[]' value='{$books['BookTitle']}'></td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        
        }

    }*/



    include ('footer.php');
    ?>

</body>
</html>
