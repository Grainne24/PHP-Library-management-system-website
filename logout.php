<?php
    session_start();
    session_destroy(); //destroy session - no longer running
    header("Location: index.php");
?>