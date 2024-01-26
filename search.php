<?php

    include('database.php'); //connection to database

    session_start(); //resume existing session

    if (!isset($_SESSION["username"])) //if the user is not loginned in, go back to start page
    {
        header('Location: logout.php');
        exit;
    }

    $categories = array();
    $sql = "SELECT * FROM category"; //selects elements in category
    $result = $conn->query($sql); //connects ti the database to carry out the query

    if($result->num_rows > 0) //if there are elements in category
    {
        while($category = $result->fetch_assoc()) 
        {
            $categories[$category['CategoryID']] = $category['CategoryDepartment']; //stores CategoryID as the keys and CategoryDepartment as the values
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Library System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
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
        include 'header.php'; 
    ?>

        <h2>Search for a book</h2>
        <form id="loginPage" method="post" action="">

            <div class="input-container">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Title">
            </div>

            <div class="input-container">
                <label for="author">Author</label>
                <input type="text" id="author" name="author" placeholder="Author">
            </div>

            <label for="category">Category</label>
            <select name="category" id="catSelect">
                <option value="">Select a category</option>

                <?php
                    foreach ($categories as $catId => $catName) //take all the keys and values in caetgories and display them in the drop down select
                    {
                        echo "<option value=".$catId.">$catName</option>";
                    }
                ?>
            
            </select>

            <div class="warning-box"></div>
            <button name="search" type="submit" class="login-button">Search</button>
            <br>
            <a href="logout.php">Logout</a>
        </form>

    <?php 
        include 'footer.php'; 
    ?>
</body>
</html>

<?php

if(isset($_POST['search']))
{
   $title = $_POST['title'];
   $author = $_POST['author'];
   $cat = $_POST['category'];
   $sql = "SELECT * FROM books WHERE BookTitle LIKE '%".$title."%' AND Author LIKE '%".$author."%'"; //selecting the authors and booktitles, can find some of the word because of the % - it looks at the start and the end of the word

   if (!empty($cat)) 
   {
        $sql .= " AND Category = $cat"; //adds AND Category if the category is picked and adds it to the sql statement
   }

   $result = $conn->query($sql);
   $books = array(); //used to store data from the database into an array
   $count = 0;

   if($result->num_rows > 0) //if its not empty
   {
        while($book = $result->fetch_assoc()) 
        {
            $books[$count++]=$book; //search results are being retrieved and stored into the array
        }

   }
   
   else
   {
      echo "No results.";
   }

   if(count($books)>0)
   {

    $items_per_page = 5; //only allowed to have 5 elements on one page 
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1; //used to check if page is set in the URL - used for pagination (limits page to 5) - if else loop
    $start_index = ($page - 1) * $items_per_page;

    $num_books = count($books);

    $current_books = array_slice($books, $start_index, $items_per_page); //used to get subset of booke from all books

    echo "<div style='text-allign: center; '>";
    echo "<br></br>";
    echo "<br></br>";
    echo "<table style='margin: 0 auto;'>";
    echo "<table border='2'>";
    echo "<thead><tr><th>ISBN</th><th>Title</th><th>Author</th><th>Edition</th><th>Year</th><th>Reservation</th></tr></thead>";
    echo "<tbody>";

    foreach ($current_books as $book) //for each book found print the contents
    {
        echo "<tr>";
        echo "<td>{$book['ISBN']}</td>";
        echo "<td>{$book['BookTitle']}</td>";
        echo "<td>{$book['Author']}</td>";
        echo "<td>{$book['Edition']}</td>";
        echo "<td>{$book['Year']}</td>";
        echo "<td><a href='reservebysearch.php?ISBN={$book['ISBN']}'>Reserve</a></td>"; //reserve book
        echo "</tr>";
    }

    echo "</tbody>";
    echo "<tfoot><tr><td colspan='6'>Total Number of Books: {$num_books}</td></tr></tfoot>"; //shows the number of books on search
    echo "</table>";
    echo "</div>";

   }
   
}

?>