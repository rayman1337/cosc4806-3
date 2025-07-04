<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f0f0f0;
            padding-top: 60px;
        }

        .container {
            background-color: white;
            max-width: 400px;
            margin: auto;
            padding: 20px 30px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 7px;
            margin-top: 4px;
            margin-bottom: 15px;
            border: 1px solid #aaa;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 8px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0069d9;
        }

        .message {
            text-align: center;
            margin-bottom: 10px;
        }

        .message.error {
            color: red;
        }

        .message.success {
            color: green;
        }

        p a {
            text-align: center;
            display: block;
            color: #007bff;
            text-decoration: none;
            margin-top: 10px;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Assignment-3: Create User</h2>

        <?php if (!empty($data['error'])): ?>
            <div class="message error"><?= $data['error'] ?></div>
        <?php endif; ?>

        <?php if (!empty($data['success'])): ?>
            <div class="message success"><?= $data['success'] ?></div>
        <?php endif; ?>

        <form method="POST" action="/create/register">
            <label>Username:
                <input type="text" name="username" required>
            </label>

            <label>Password:
                <input type="password" name="password" required>
            </label>

            <input type="submit" value="Create User">
        </form>

        <p><a href="/login">Back to Login</a></p>
    </div>
</body>
</html>
