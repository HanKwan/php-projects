<?php include_once 'inc/header.php'; ?>

<?php 
    $nameErr = $emailErr = $feedErr = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {  // POST nned to be written in uppercase
        $username = $_POST['username'];
        $email = $_POST['email'];
        $feedback = $_POST['feedback'];

        if (empty($username)) {
            $nameErr = 'Username is required';
        }
        if (empty($email)) {
            $emailErr = 'email is required';
        }
        if (empty($feedback)) {
            $feedErr = 'feedback is required';
        }
    }
?>

    <main>
        <section class="section01">
            <form action="home.php" method="post">
            <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control <?php echo $nameErr ? 'is-invalid' : null ?>">
                    <?php if ($nameErr) { ?>
                        <div class="invalid-feedback">
                            <?php echo $nameErr ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null ?>">
                    <?php if ($emailErr) { ?>
                        <div class="invalid-feedback">
                            <?php echo $emailErr ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="feedback" class="form-label">feedback</label>
                    <input type="text" name="feedback" class="form-control <?php echo $feedErr ? 'is-invalid' : null ?>">
                    <?php if ($feedErr) { ?>
                        <div class="invalid-feedback">
                            <?php echo $feedErr ?>
                        </div>
                    <?php } ?>
                </div>
                <button type="submit" class="submitBtn">Submit</button>
            </form>
        </section>
    </main>
<?php include_once 'inc/footer.php'; ?>
