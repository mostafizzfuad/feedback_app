<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user'];
    $feedback = $_POST['feedback'];
    $feedbacks = [];
    if (file_exists("data/feedback/$user_id.json")) {
        $feedbacks = json_decode(file_get_contents("data/feedback/$user_id.json"), true);
    }
    $feedbacks[] = $feedback;
    file_put_contents("data/feedback/$user_id.json", json_encode($feedbacks));
    $success = "Thank you for your feedback!";
}
include 'templates/header.php';
?>
<h2>Feedback</h2>
<?php if (isset($success)) : ?>
<p style="color: green;"><?php echo $success; ?></p>
<?php endif; ?>
<form method="POST">
    <input type="hidden" name="user" value="<?php echo htmlspecialchars($_GET['user']); ?>">
    <label for="feedback">Your Feedback:</label>
    <textarea id="feedback" name="feedback" required></textarea>
    <button type="submit">Submit</button>
</form>
<?php include 'templates/footer.php'; ?>