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
        </ul>

        <p><a href="adduser.php">Add</a></p>

        <?php
        echo "<table border='1' bgcolor='#fff'>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Password</th>
            <th>Name</th>
            <th>Action</th>
        </tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td><a href='edituser.php?id=" . $row['id'] . "'>Edit</a> | <a href='deluser.php?id=" . $row['id'] . "'>Del</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
</body>
</html>
