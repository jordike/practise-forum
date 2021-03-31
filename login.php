<?php
    $current_page = "Login";

    require_once("_config.php");
    require_once("components/page-start.php");
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
                        <input type="submit" name="register" value="Register">
                    </div>
                </form>

<?php require_once("components/page-end.php"); ?>
