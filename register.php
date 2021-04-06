<?php
    // Test to see if the user is already logged in.
    session_start();

    if ($_SESSION["logged_in"] ?? false) {
        // The user is already logged in. Redirect back.
        header("Location: index.php");
    }

    // Set current page for the title.
    $current_page = "Register";

    // Include important files.
    require_once("_config.php");
    require_once("util.php");
    require_once("db.php");

    // Add page-start file. Everything not specific to this page is in here.
    require_once("components/page-start.php");

    // Check if the user pressed the register button.
    if (isset($_POST["register"])) {
        // Fetch the username and email.
        $_username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);

        // Check if the username or email already exist. There cannot be two people
        // with the same username and email.
        if (!username_exists($_username) && !email_exists($email)) {
            // TODO: Limiet toevoegen aan wat wel of niet
            //       mag als wachtwoord en gebruikersnaam.

            // Prepare query.
            $query = $db->prepare("INSERT INTO accounts (email, username, password) VALUES (:email, :username, :password)");

            // Fetch and filter parameters.
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $password = sha1(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));

            // Bind parameters
            $query->bindParam("email", $email);
            $query->bindParam("username", $username);
            $query->bindParam("password", $password);
            // We don't set the level, because
            // in defaults to 1. This is set in the SQL database.

            // TODO: betere fout afhandeling.
            if ($query->execute()) {
                login($username, 1);
            } else {
                create_dialog("An internal error has occured. Your account has <strong>not</strong> been made.", "error-message");
            }
        } else {
            create_dialog("That username or email has already been used. Choose another one, and try again.", "error-message");
        }
    }
?>

                <h2>Register</h2>
                <form action="#" method="POST">
                    <div class="form-input">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class="form-input">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="form-input">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="form-input">
                        <input type="submit" name="register" value="Register">
                    </div>
                </form>

<?php require_once("components/page-end.php"); ?>
