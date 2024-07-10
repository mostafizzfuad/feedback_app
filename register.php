<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users = json_decode(file_get_contents('data/users.json'), true);
    $user_id = uniqid();
    $users[$user_id] = [
        'username' => $_POST['username'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ];
    file_put_contents('data/users.json', json_encode($users));
    header('Location: login.php');
    exit;
}
include 'templates/header.php';
?>
<h2>Register</h2>
<form method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Register</button>
</form>
<?php include 'templates/footer.php'; ?>