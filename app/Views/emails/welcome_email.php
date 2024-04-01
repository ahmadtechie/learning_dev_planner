<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to LD Planner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .login-details {
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Welcome to LD Planner</h1>
    <p>Greetings <?= $username ?? 'None'; ?>,</p>
    <p>Welcome!!! <?= $user_roles ?? ''; ?> account was created for you on LD Planner, find below your login details:</p>
    <div class="login-details">
        <p><strong>Login Username:</strong> <?= $username ?? ''; ?></p>
        <p><strong>Login Email Address:</strong>  <?= $email ?? ''; ?></p>
        <p><strong>Login Password:</strong>  <?= $password ?? ''; ?></p>
        <p><strong>For security purposes, please change your password on first login.</strong></p>
    </div>
    <p><a href="<?= url_to('ldm.login') ?>" class="button">LOGIN PAGE</a></p>
</div>
</body>
</html>
