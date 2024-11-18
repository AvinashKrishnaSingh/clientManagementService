<!-- initalizedatabaseformview.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #form_view {
            max-width: 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .container {
            width: 100%;
            text-align: center;
        }

        button {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            background-color: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        .message {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div id="form_view">
        <div class="container">
            <h2>Database Setup</h2>
            <form action="<?= URLROOT ?>/setupDatabase" method="POST">
                <button type="submit" name="setup">Initialize Database</button>
                <?php if (isset($_GET['error'])): ?>
                    <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
                <?php endif; ?>

            </form>
        </div>
    </div>
</body>
</html>