<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/style.css?v=3') ?>">
    <title>Customers - POS System</title>
</head>
<body>
    <nav>
<a href="<?= site_url() ?>">Home</a>
<a href="<?= site_url('about') ?>">About</a>
<a href="<?= site_url('customers') ?>">Customers</a>
<a href="<?= site_url('users') ?>">Users</a>
<a href="<?= site_url('logout') ?>">Logout</a>
    </nav>

    <h1>Customer Accounts</h1>

    <div class="page-actions">
        <a class="button" href="<?= site_url('customers/new') ?>">New Customer</a>
    </div>

    <?php if (! empty($success)): ?>
        <p class="alert alert-success"><?= esc($success) ?></p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone']) ?></td>
                    <td><a class="text-link" href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
