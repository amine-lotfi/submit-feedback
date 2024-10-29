<?php include 'templates/header.php'; ?>

<?php
$sql = "SELECT * from feedback";
$result = mysqli_query($conn, $sql);
$feedbacks = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($conn);
?>

<h2>What our clients say about us:</h2>
<?php foreach ($feedbacks as $feedback): ?>
    <div class="card w-50 mb-3">
        <div class="card-body">
            <?php echo htmlspecialchars($feedback['feedback_text']); ?>
            <p class="p-0 m-0 mt-3">By: <?php echo htmlspecialchars($feedback['name']); ?>
                - <?php echo htmlspecialchars($feedback['date']); ?></p>
        </div>
    </div>
<?php endforeach; ?>

<?php include 'templates/footer.php'; ?>