<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <title>Customers - POS System</title>
</head>
<body>
    <nav>
<a href="<?= site_url('/') ?>">Home</a>
<a href="<?= site_url('about') ?>">About</a>
<a href="<?= site_url('customers') ?>">Customers</a>
<a href="<?= site_url('users') ?>">Users</a>
    </nav>

    <h1>Customer Accounts</h1>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>