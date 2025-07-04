    <?php require_once 'app/views/templates/header.php' ?>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f0f0f0;
            padding-top: 60px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            border: 1px solid #ccc;
            text-align: center;
        }

        h1 {
            margin-bottom: 10px;
        }

        .lead {
            color: #555;
            margin-bottom: 20px;
            font-size: 16px;
        }

        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="container">
        <h1>Hey</h1>
        <p class="lead"><?= date("F jS, Y"); ?></p>

        <p><a href="/logout">Click here to logout</a></p>
    </div>

    <?php require_once 'app/views/templates/footer.php' ?>
