<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/style.css?v=3') ?>">
    <title><?= esc($title) ?> - POS System</title>
</head>
<body>
    <nav>
        <a href="<?= site_url() ?>">Home</a>
        <a href="<?= site_url('about') ?>">About</a>
        <a href="<?= site_url('customers') ?>">Customers</a>
        <a href="<?= site_url('users') ?>">Users</a>
    </nav>

    <h1><?= esc($title) ?></h1>

    <?php if ($errors !== []): ?>
        <div class="alert alert-error" role="alert">Please correct the highlighted fields.</div>
    <?php endif; ?>

    <form class="form-card" action="<?= esc($action) ?>" method="post" novalidate>
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input id="full_name" name="full_name" type="text" maxlength="100" required value="<?= esc($customer['full_name']) ?>">
            <?php if (isset($errors['full_name'])): ?><p class="field-error"><?= esc($errors['full_name']) ?></p><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" maxlength="100" required value="<?= esc($customer['email']) ?>">
            <?php if (isset($errors['email'])): ?><p class="field-error"><?= esc($errors['email']) ?></p><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input id="phone" name="phone" type="text" maxlength="20" value="<?= esc($customer['phone']) ?>">
            <?php if (isset($errors['phone'])): ?><p class="field-error"><?= esc($errors['phone']) ?></p><?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit"><?= esc($submitLabel) ?></button>
            <a class="button button-secondary" href="<?= site_url('customers') ?>">Cancel</a>
        </div>
    </form>
</body>
</html>
