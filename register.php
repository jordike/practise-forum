<?php
    $current_page = "Register";

    require_once("_config.php");
    require_once("components/page-start.php");

    require_once("db.php");

    if (isset($_POST["register"])) {
        $_username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);

        if (!username_exists($_username)) {
            $query = $db->prepare("INSERT INTO accounts (email, username, password) VALUES (:email, :username, :password)");

            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $password = sha1(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));

            $query->bindParam("email", $email);
            $query->bindParam("username", $username);
            $query->bindParam("password", $password);

            // TODO: betere fout afhandeling.
            if ($query->execute()) {
                echo "aangemaakt";
            } else {
                echo "niet aangemaakt";
            }
        } else {
            echo "bestaat al";
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
