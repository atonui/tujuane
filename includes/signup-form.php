<?php
if (isset($_POST['signup'])) {
    $screenName = $_POST['screenName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($screenName) or empty($email) or empty($email)) {
        $error = "Please fill in all fields";
    } else {
        $email = $getFromUser->cleanInput($email);
        $password = $getFromUser->cleanInput($password);
        $screenName = $getFromUser->cleanInput($screenName);
        if (!filter_var($email)) {
            $error = "Invalid email address";
        } elseif (strlen($screenName) > 20) {
            $error = "Name must be between 6 - 20 characters";
        } elseif (strlen($password) < 5) {
            $error = "The password is too short";
        } else {
            if ($getFromUser->checkEmail($email) == true) {
                $error = "Email is already in use";
            } else {
                $getFromUser->register($email, $screenName, $password);
                header('location:home.php');
            }
        }
    }
}
?>

<form method="post">
    <div class="signup-div">
        <h3>Sign up </h3>
        <ul>
            <li>
                <input type="text" name="screenName" placeholder="Full Name"/>
            </li>
            <li>
                <input type="email" name="email" placeholder="Email"/>
            </li>
            <li>
                <input type="password" name="password" placeholder="Password"/>
            </li>
            <li>
                <input type="submit" name="signup" Value="Signup for Twitter">
            </li>
        </ul>
        <?php
        if (isset($error)) {
            echo '<li class="error-li">
                    <div class="span-fp-error">'.$error.'</div>
                  </li>';
        }
        ?>
    </div>
</form>
