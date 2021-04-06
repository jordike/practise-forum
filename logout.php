<?php
    session_start();

    // Unset all session variables.
    unset($_SESSION["username"]);
    unset($_SESSION["logged_in"]);
    unset($_SESSION["level"]);

    // Redirect to the homepage.
    header("Location: index.php");
?>

<p>Redirecting...</p>
