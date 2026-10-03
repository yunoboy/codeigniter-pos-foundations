<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/style.css?v=3') ?>">
    <title>Users - POS System</title>
</head>
<body>
    <nav>
<a href="<?= site_url() ?>">Home</a>
<a href="<?= site_url('about') ?>">About</a>
<a href="<?= site_url('customers') ?>">Customers</a>
<a href="<?= site_url('users') ?>">Users</a>
    </nav>

    <h1>User Accounts</h1>

    <div class="page-actions">
        <a class="button" href="<?= site_url('users/new') ?>">New User</a>
    </div>

    <?php if (! empty($success)): ?>
        <p class="alert alert-success"><?= esc($success) ?></p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Avatar</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <?php $avatarFile = ! empty($user['avatar']) ? rawurlencode($user['avatar']) : 'placeholder.svg'; ?>
                        <img class="avatar" src="<?= base_url('uploads/avatars/' . $avatarFile) ?>" alt="Avatar for <?= esc($user['full_name']) ?>">
                    </td>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td><?= esc($user['created_at']) ?></td>
                    <td><a class="text-link" href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
