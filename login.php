<?php
    $current_page = "Login";

    require_once("_config.php");
    require_once("components/page-start.php");

    require_once("db.php");

    if (isset($_POST["login"])) {
        $query = $db->prepare("SELECT * FROM accounts WHERE email = :email AND password = :password");

        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
        $password = sha1(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));

        $query->bindParam("email", $email);
        $query->bindParam("password", $password);

        try {
            if (!$query->execute()) {
                echo "interne fout";
            }
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }

        // TODO: Betere fout afhandeling.
        if ($query->rowCount() == 1) {
            echo "login";
        } else {
            echo 'fout';
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
