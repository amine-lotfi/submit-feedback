<?php include 'templates/header.php'; ?>

<?php
$name = $email = $feedback = '';
$name_error = $email_error = $feedback_error = '';

// form submit
if (isset($_POST['submit'])) {
    // name validation
    if (empty($_POST['name'])) {
        $name_error = 'Please enter your name';
    } else {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    // email validation
    if (empty($_POST['email'])) {
        $email_error = 'Please enter your email';
    } else {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    }
    // feedback validation
    if (empty($_POST['feedback'])) {
        $feedback_error = 'Please enter your feedback';
    } else {
        $feedback = filter_var($_POST['feedback'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    // to insert into the db
    if (empty($name_error) && empty($email_error) && empty($feedback_error)) {
        //query
        $sql = "INSERT INTO feedback(name, email, feedback_text) VALUES('$name', '$email', '$feedback')";
        if (mysqli_query($conn, $sql)) {
            // success -> redirect to feedback.php
            header('Location: feedbacks.php');
        } else {
            // error
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}
?>


<img src="res/img-logo.png" alt="LOGO" class="img-fluid mb-3">
<h2>Feedback</h2>
<p class="lead fs-6">Leave us feedback to help us improve our services!</p>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mt-2 w-75">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo !empty($name_error) ? 'is-invalid' : ''; ?>" id="name" name="name" placeholder="Enter your name" value="<?php echo $name; ?>">
        <div id="validationServerFeedback" class="invalid-feedback">
            <?php echo $name_error; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo !empty($email_error) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
        <div id="validationServerFeedback" class="invalid-feedback">
            <?php echo $email_error; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="feedback" class="form-label">Feedback</label>
        <textarea rows="5" class="form-control <?php echo !empty($feedback_error) ? 'is-invalid' : ''; ?>" id="feedback" name="feedback" placeholder="Enter your feedback"><?php echo $feedback; ?></textarea>
        <div id="validationServerFeedback" class="invalid-feedback">
            <?php echo $feedback_error; ?>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <input type="submit" name="submit" class="btn btn-primary w-25">
    </div>
</form>
<?php include 'templates/footer.php'; ?>