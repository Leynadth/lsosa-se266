<?php
include __DIR__ . '/models/model_patients.php';

session_start();

if (isset($_POST['login'])) {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    $user = login($username, $password);

    if ($user) {
        $_SESSION['user'] = $username;
        header('Location: search.php');
        exit;
    } else {
        session_unset();
        $login_error = "Invalid username or password.";
    }
} else {
    $username = '';
    $password = '';
}

?>

<form name="login" method="post">
    <h2>Login</h2>
    <div class="wrapper">
        <div class="label">
            <label>Username:</label>
        </div>
        <div>
            <input type="text" name="username" value="<?= htmlspecialchars($username); ?>" />
        </div>
        <div class="label">
            <label>Password:</label>
        </div>
        <div>
            <input type="password" name="password" value="<?= htmlspecialchars($password); ?>" />
        </div>
        <div>
            &nbsp;
        </div>
        <div>
            <input type="submit" name="login" value="Login" />
        </div>
        <?php if (isset($login_error)) { ?>
            <div style="color:red;">
                <?= $login_error; ?>
            </div>
        <?php } ?>
    </div>
</form>
