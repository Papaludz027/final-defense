<?php session_start(); ?>
<?php
include 'db.php';
$user_id = $_REQUEST['id'];

$result = mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_id'");
$test = mysqli_fetch_array($result);
if (!$result) {
    die("Error: Data not found..");
}
$id = $test['id'];
$username = $test['username'];
$password = $test['password'];
$name = $test['name'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit User</title>
    <style type="text/css">
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, black, yellow, green);
        }
        .container {
            text-align: center;
            background-color: lightgray;
            padding: 20px;
            border-radius: 5px;
        }
        table {
            margin: 0 auto;
        }
        table td {
            padding: 5px;
        }
        input[type="text"] {
            width: 200px;
        }
        input[type="submit"] {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Users Update</h1>
        <form method="post" action="edituserecex.php">
            <table>
                <tr>
                    <td><input type="hidden" name="id" value="<?php echo $id; ?>" /></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>" /></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="text" name="password" value="<?php echo $password; ?>" /></td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="name" value="<?php echo $name; ?>" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="save" value="Edit" /></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
