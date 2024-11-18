<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #002B72; /* Dark Blue */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        text-align: center;
        background-color: #002B72;
        border-radius: 10px;
        padding: 20px;
        width: 350px;
    }


    .logo img {
        max-width: 80%;
        max-height: 80%;
        margin-bottom: 80px;

    }

    .login-form {
    display: flex;
    flex-direction: column; /* Stack items vertically */
    align-items: center; /* Center items horizontally */
    gap: 15px; /* Space between the fields and button */
    }

.input-field {
    padding: 10px;
    border: none;
    border-radius: 25px;
    font-size: 16px;
    width: 100%; /* Fields span the full form width */
}

.login-button {
    background-color: #00CFFF;
    color: white;
    font-size: 18px;
    padding: 15px 30px; /* Adjust size */
    border: none;
    border-radius: 25px;
    cursor: pointer;
    width: 50%; /* Ensure button matches the field widths */
    transition: background-color 0.3s ease;
    text-align: center; /* Center text inside the button */
}

.login-button:hover {
    background-color: #009FCC;
}


    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="<?= URLROOT ?>../images/logo.png" alt="Logo">
        </div>
        <form class="login-form">
            <input type="text" placeholder="Username" class="input-field">
            <input type="password" placeholder="Password" class="input-field">
            <button type="submit" class="login-button">Login</button>
        </form>
    </div>
</body>
</html>
