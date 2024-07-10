<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users = json_decode(file_get_contents('data/users.json'), true);
    foreach ($users as $user_id => $user) {
        if ($user['username'] == $_POST['username'] && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user'] = $user_id;
            header('Location: dashboard.php');
            exit;
        }
    }
    $error = "Invalid credentials.";
}
include 'templates/header.php';
?>
<h2>Login</h2>
<?php if (isset($error)) : ?>
<p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>
<form method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Login</button>
</form>
<?php include 'templates/footer.php'; ?>