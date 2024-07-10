<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$user_id = $_SESSION['user'];
$feedbacks = [];
if (file_exists("data/feedback/$user_id.json")) {
    $feedbacks = json_decode(file_get_contents("data/feedback/$user_id.json"), true);
}
include 'templates/header.php';
?>
<h2>Dashboard</h2>
<p>Your unique feedback link: <a href="feedback.php?user=<?php echo $user_id; ?>">Click here</a></p>
<h3>Feedback received:</h3>
<ul>
    <?php foreach ($feedbacks as $feedback) : ?>
    <li><?php echo htmlspecialchars($feedback); ?></li>
    <?php endforeach; ?>
</ul>
<?php include 'templates/footer.php'; ?>