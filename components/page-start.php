<?php
    // A session may already exist,
    // because this file is imported in other files.
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/form.css">
        <link rel="stylesheet" href="css/dialogs.css">

        <title><?php echo "$site_name - $current_page"; ?></title>
    </head>
    <body>
        <div id="page-container">
            <header>
                <h1><?php echo $site_name; ?></h1>
                <nav>
                    <a href="index.php">Home</a>
                    <span class="nav-align-right">
                        <?php
                            if ($_SESSION["logged_in"] ?? false) {
                                // The user is logged in. Display the logout button
                                // instead.

                                $username = $_SESSION["username"];

                                echo "<a class=\"nav-item\" href=\"logout.php\">Logout</a>";
                                echo "<span class=\"nav-item\" id=\"nav-username\">$username</span>";
                            } else {
                                // The user is not logged in.
                                // Display the login and register buttons.

                                echo "<a class=\"nav-item\" href=\"login.php\">Login</a>";
                                echo "<a class=\"nav-item\" href=\"register.php\">Register</a>";
                            }
                        ?>
                    </span>
                </nav>
            </header>
            <div class="container">
