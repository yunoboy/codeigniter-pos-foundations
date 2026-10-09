<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/style.css?v=4') ?>">
    <title>Login - POS System</title>
</head>
<body>
    <nav>
        <a href="<?= site_url() ?>">Home</a>
        <a href="<?= site_url('about') ?>">About</a>
    </nav>

    <h1>POS Login</h1>

    <?php if (! empty($errors['login'])): ?>
        <p class="alert alert-error"><?= esc($errors['login']) ?></p>
    <?php endif; ?>

    <?php if (! empty($errors['username'])): ?>
        <p class="alert alert-error"><?= esc($errors['username']) ?></p>
    <?php endif; ?>

    <?php if (! empty($errors['password'])): ?>
        <p class="alert alert-error"><?= esc($errors['password']) ?></p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <p class="alert alert-error">
            <?= esc(session()->getFlashdata('error')) ?>
        </p>
    <?php endif; ?>

    <form class="form-card" action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="username">Username</label>
            <input
                id="username"
                name="username"
                type="text"
                required
                value="<?= esc($username) ?>"
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                id="password"
                name="password"
                type="password"
                required
            >
        </div>

        <button type="submit">Log In</button>

        <p class="help-text">
            Existing users use the password:
            <strong>password</strong>
        </p>
    </form>
</body>
</html>