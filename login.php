<?php
    // Test to see if the user is already logged in.
    session_start();

    if ($_SESSION["logged_in"] ?? false) {
        // The user is already logged in. Redirect back.
        header("Location: index.php");
    }

    // Set current page for the title.
    $current_page = "Login";

    // Include important files.
    require_once("_config.php");
    require_once("util.php");
    require_once("db.php");

    // Add page-start file. Everything not specific to this page is in here.
    require_once("components/page-start.php");

    // Check if the user pressed the login button.
    if (isset($_POST["login"])) {
        // Prepare the query.
        $query = $db->prepare("SELECT * FROM accounts WHERE email = :email AND password = :password");

        // Fetch and filter input.
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
        $password = sha1(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));

        // Bind parameters.
        $query->bindParam("email", $email);
        $query->bindParam("password", $password);

        // Check if the query was a success.
        if (!$query->execute()) {
            create_dialog("An internal error has occured. You have not been logged in.", "error-message");
        }

        // TODO: Betere fout afhandeling.
        if ($query->rowCount() == 1) {
            // We use the first item in the array,
            // because we only have one result.
            // Therefore, we don't need to loop over it.
            $result = $query->fetchAll(PDO::FETCH_ASSOC)[0];

            login($result["username"], $result["level"]);
        } else {
            create_dialog("Your email or password is not correct. Please, try again.", "error-message");
        }
    }
?>

                <h2>Login</h2>
                <form action="#" method="POST">
                    <div class="form-input">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="form-input">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="form-input">
                        <input type="submit" name="login" value="Login">
                    </div>
                </form>

<?php require_once("components/page-end.php"); ?>
