<!-- succefulcreationview.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            text-align: center;
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
            margin-bottom: 10px;
        }

        #countdown {
            color: #3498db;
            font-weight: bold;
        }

        button {
            width: 100%;
            padding: 8px;
            background-color: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Database was successfully initialized.</h1>
        <p>The page will redirect to the home  page in <span id="countdown">5</span> seconds.</p>
        <p>If you are not redirected, click the button below.</p>
     
        <button onclick="window.location.href= "<?= URLROOT ?>/initializeDatabase">Go to Home Page</button>
     
    
    </div>

    <script>
        // JavaScript code for countdown
        let countdownElement = document.getElementById("countdown");
        let countdownValue = 5; // set the initial countdown value

        function updateCountdown() {
            countdownValue--;
            countdownElement.textContent = countdownValue;

            if (countdownValue <= 0) {
               
                window.location.href = '<?php echo URLROOT ?>/Homepage';

            }
        }

        // Update the countdown every second
        setInterval(updateCountdown, 1000);
    </script>
</body>
</html>
