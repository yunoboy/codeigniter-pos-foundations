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

    <form class="form-card" action="<?= esc($action) ?>" method="post" enctype="multipart/form-data" novalidate>
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" maxlength="50" required value="<?= esc($user['username']) ?>">
            <?php if (isset($errors['username'])): ?><p class="field-error"><?= esc($errors['username']) ?></p><?php endif; ?>
        </div>

        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input id="full_name" name="full_name" type="text" maxlength="100" required value="<?= esc($user['full_name']) ?>">
            <?php if (isset($errors['full_name'])): ?><p class="field-error"><?= esc($errors['full_name']) ?></p><?php endif; ?>
        </div>

        <?php if ($allowAvatar): ?>
            <div class="form-group">
                <label for="avatar">Profile Picture</label>
                <?php $currentAvatar = ! empty($user['avatar']) ? rawurlencode($user['avatar']) : 'placeholder.svg'; ?>
                <img class="avatar-preview" src="<?= base_url('uploads/avatars/' . $currentAvatar) ?>" alt="Current avatar">
                <input id="avatar" name="avatar" type="file" accept="image/jpeg,image/png">
                <p class="help-text">Optional. JPG or PNG only, maximum 2 MB. The saved image is cropped to 300 by 300 pixels.</p>
                <?php if (isset($errors['avatar'])): ?><p class="field-error"><?= esc($errors['avatar']) ?></p><?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="form-actions">
            <button type="submit"><?= esc($submitLabel) ?></button>
            <a class="button button-secondary" href="<?= site_url('users') ?>">Cancel</a>
        </div>
    </form>
</body>
</html>
