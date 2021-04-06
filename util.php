<?php
    function username_exists(string $username): bool {
        // Allow access to the $db variable, defined in db.php
        global $db;

        // Prepare query.
        $query = $db->prepare("SELECT username FROM accounts WHERE username = :username");

        // Bind parameter.
        $query->bindParam("username", $username);

        // Check for success.
        if (!$query->execute()) {
            // If the query failed, we assume the username exists
            // to prevent them from getting added.
            return true;
        }

        // If this username exists, there are rows.
        // If there are no rows, the username does not exist.
        // This expression returns either true or false, which we need.
        return $query->rowCount() != 0;
    }

    function email_exists(string $email): bool {
        // Allow access to the $db variable, defined in db.php
        global $db;

        // Prepare the query.
        $query = $db->prepare("SELECT email FROM accounts WHERE email = :email");

        // Bind parameter
        $query->bindParam("email", $email);

        // Check for success.
        if (!$query->execute()) {
            // If the query failed, we assume the email exists
            // to prevent them from getting added.
            return true;
        }

        // If this email exists, there are rows.
        // If there are no rows, the email does not exist.
        // This expression returns either true or false, which we need.
        return $query->rowCount() != 0;
    }

    // TODO: make $type an enum instead of a string?
    function create_dialog(string $message, string $type): void {
        echo "<div class=\"container dialog $type\">";
            echo "<p>$message</p>";
        echo "</div>";
    }

    function login(string $username, int $level): void {
        $_SESSION["username"] = $username;
        $_SESSION["logged_in"] = true;
        $_SESSION["level"] = $level;

        // Redirect to home page, but logged in this time.
        header("Location: index.php");
    }
?>
