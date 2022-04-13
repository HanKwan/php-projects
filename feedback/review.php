<?php include_once 'inc/header.php'; ?>

<?php 
    $statement = $pdo->prepare("SELECT * FROM customer_feedback ORDER BY date DESC");
    $statement->execute();
    $feedback = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

    <main class="fb_main mt-5">
        <h1>Feedbacks/reviews</h1>
        <?php foreach ($feedback as $feedback): ?>
            <div class="card mt-5">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $feedback['username'] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $feedback['email'] ?></h6>
                    <p class="card-text"><?php echo $feedback['body'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </main>
<?php include_once 'inc/footer.php'; ?>