<?php require_once __DIR__ . '../../header.php'; ?>
<h2>Log in</h2>

<?php /** @var \App\Data\ErrorDTO $error */ ?>
<?php if ($errors): ?>
    <p style="color: red">
        <?= $errors->getMassege(); ?>
    </p>
<?php endif; ?>
<div class="container">
    <form method="post">
        <label>Username:   </label> 
        <input type="text" name="username"/><br>

        <label>Password:</label>
        <input type="password" name="password"/><br>

        <input type="submit" name="login" value="Login"/>


    </form>
</div>




