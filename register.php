<?php
    $current_page = "Register";

    require_once("_config.php");
    require_once("components/page-start.php");
?>

                <h2>Register</h2>
                <form action="#" method="POST">
                    <div class="form-input">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username">
                    </div>
                    <div class="form-input">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div class="form-input">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <input type="submit" name="register" value="Register">
                </form>

<?php require_once("components/page-end.php"); ?>
