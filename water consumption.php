<?php
session_start();

// Check if the password is submitted
if (isset($_POST['password'])) {
    $password = $_POST['password'];

    // Compare the entered password with the correct password
    if ($password === "admin123") {
        $_SESSION['authenticated'] = true;
        header("Location: user.php"); // Redirect to the user.php page after successful authentication
        exit();
    } else {
        $errorMessage = "Incorrect password. Please try again.";
    }
}

// Check if the user is authenticated
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    // Display the password form
    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Password Protected</title>
        <style type="text/css">
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                padding: 0;
                background-color: lightgray;
            }
            .container {
                text-align: center;
                background-color: green;
                padding: 20px;
                border-radius: 5px;
            }
            input[type="password"], input[type="submit"] {
                margin: 10px;
            }
            .error-message {
                color: red;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form method="POST">
                <label for="password">Enter the password:</label>
                <br>
                <input type="password" id="password" name="password" required>
                <br>
                <input type="submit" value="Submit">
                <div class="error-message">' . (isset($errorMessage) ? $errorMessage : '') . '</div>
            </form>
        </div>
    </body>
    </html>';

    exit; // Stop further execution of the page
}

// User is authenticated, continue with the rest of the page

$session = $_SESSION['authenticated']; // Update the session variable name if required
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM user");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User</title>
    <style type="text/css">
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            background-color: yellow;
        }
        .container {
            text-align: center;
            background-color: lightgray;
            padding: 20px;
            border-radius: 5px;
        }
        ul {
            list-style-type: none; /* Remove bullet points */
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        ul li {
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <p style="color:#F00; font-size:12px;">Welcome <?php echo $session; ?></p>
        <ul>
            <li><a href="billing.php">Home</a></li>
            <li><a href="bill.php">Billing</a></li>
            <li><a href="user.php">Users</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="Water Consumption">Track Water Consumption</a><li>
        </ul>

        <p><a href="adduser.php">Add</a></p>

        <div id="waterData">
            <!-- Display water flow data here -->
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            // Function to update water flow data
            function updateWaterData(data) {
                // Update the water data on the page
                $("#waterData").html(data);
            }

            // Function to fetch water flow data from Arduino
            function fetchWaterData() {
                $.ajax({
                    url: "fetch_data.php", // Update the URL based on your setup
                    method: "GET",
                    dataType: "html",
                    success: function(response) {
                        updateWaterData(response);
                        setTimeout(fetchWaterData, 1000); // Fetch data every 1 second
                    },
                    error: function() {
                        setTimeout(fetchWaterData, 1000); // Retry after 1 second in case of error
                    }
                });
            }

            // Start fetching water flow data
            fetchWaterData();
        </script>
    </div>
</body>
</html>
