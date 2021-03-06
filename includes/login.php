<?php

if (isset($_POST['login'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $getFromUser->cleanInput($_POST['email']);
        $password = $getFromUser->cleanInput($_POST['password']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format";
        } else {
//            login user
            if (!$getFromUser->login($email, $password)) {
                $error = "The email or password is incorrect";
            }
        }
    } else {
        $error = "Please fill in all fields.";
    }

}
?>

<div class="login-div">
    <form method="post">
        <ul>
            <li>
                <input type="text" name="email" placeholder="Please enter your Email here"/>
            </li>
            <li>
                <input type="password" name="password" placeholder="password"/>
                <input type="submit" name="login" value="Log in"/>
            </li>
            <li>
                <input type="checkbox" Value="Remember me">Remember me
            </li>
        </ul>
        <?php
        if (isset($error)) {
            echo '<li class="error-li">
            <div class="span-fp-error">'.$error.'</div>
        </li>';
        }
        ?>

    </form>
</div>
