<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo '<script>windows: location="index.php"</script>';
}

?>
<?php
$session = $_SESSION['id'];
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM user where id= '$session'");
while ($row = mysqli_fetch_array($result)) {
    $sessionname = $row['name'];
}

?>

<p style="color:#F00; font-size:12px;">Welcome <?php echo $sessionname; ?></p>
<?php
if (isset($_POST['add'])) {
    include 'db.php';
    $id = $_POST['id'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mi = $_POST['mi'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    // Check if the entry already exists in the database
    $query = "SELECT * FROM owners WHERE lname = '$lname' AND fname = '$fname' AND mi = '$mi'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Entry already exists, display an error message
        echo '<script>alert("Entry already exists in the database.")</script>';
    } else {
        // Entry doesn't exist, proceed with adding it to the database
        mysqli_query($conn, "INSERT INTO owners (id,lname,fname,mi,address,contact) 
                             VALUES ('$id','$lname','$fname','$mi','$address','$contact')");

        echo '<script>alert("Success")</script>';
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="lib/jquery.js" type="text/javascript"></script>
    <script src="src/facebox.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('a[rel*=facebox]').facebox({
                loadingImage: 'src/loading.gif',
                closeImage: 'src/closelabel.png'
            })
        })
    </script>
    <script src="js/application.js" type="text/javascript" charset="utf-8"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Web Application for Water Consumption in CPSU Main-Campus</title>
    <style type="text/css">
        #wrapper {
            width: 900px;
            margin: 0 auto;
            border: 3px solid rgba(0, 0, 0, 0);
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 0 18px rgba(0, 0, 0, 0.4);
            -moz-box-shadow: 0 0 18px rgba(0, 0, 0, 0.4);
            box-shadow: 0 0 18px rgba(0, 0, 0, 0.4);
            margin-top: 2%;
            background-color: lightgray;
        }

        #header {
            width: 900px;
            height: 75px;
            background-color: yellow;
        }

        table th {
            background: #999;
        }

        #form {
            width: 400px;
            float: left;
            border: 3px solid rgba(0, 0, 0, 0);
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 0 18px rgba(0, 0, 0, 0.4);
            -moz-box-shadow: 0 0 18px rgba(0, 0, 0, 0.4);
            box-shadow: 0 0 18px rgba(0, 0, 0, 0.4);
            margin-top: 5%;
            background-color: green;
        }

        #ryt {
            float: right;
            border: 3px solid rgba(0, 0, 0, 0);
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 0 18px rgba(0, 0, 0, 0.4);
            -moz-box-shadow: 0 0 18px rgba(0, 0, 0, 0.4);
            box-shadow: 0 0 18px rgba(0, 0, 0, 0.4);
            margin-top: 5%;
            background-color: yellow;
        }

        #header ul li {
            list-style: none;
            float: left;
            margin-top: 30px;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <ul>
                <li><a href="billing.php">Home</a></li>
                <li><a href="bill.php">Billing</a></li>
                <li><a href="user.php">Users</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <h1 align="center">Web Application for Water Consumption in CPSU Main Campus</h1>
        <div id="form">

            <p>
                <h1 align="center">Add Client</h1>
            </p>
            <form method="post">
                <table width="332" border="0">
                    <tr>
                        <td width="99"><input type="hidden" name="id" value="0" /></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td width="223"><input type="text" name="lname" /></td>
                    </tr>
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" name="fname" /></td>
                    </tr>
                    <tr>
                        <td>MI:</td>
                        <td><input type="text" name="mi" /></td>

                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><input type="text" name="address" /></td>

                    </tr>
                    <tr>
                        <td>Contact #:</td>
                        <td><input type="text" name="contact" /></td>

                    </tr>
                    <tr>

                        <td><input type="submit" name="add" value="ADD" /></td>
                        <td><input type="reset" value="CANCEL" /></td>
                    </tr>

                </table>
            </form>

        </div>
        <div id="ryt">
            <h1 align="center">View</h1>
            <?php
            include 'db.php';
            $result = mysqli_query($conn, "SELECT * FROM owners");

            echo "<table border='1' bgcolor='#fff'>
<tr>
<th>Id</th>
<th>Firstname</th>
<th>Lastname</th>
<th>Mi</th>
<th>Address</th>
<th>Contact</th>
<th>Action</th>
</tr>";

            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['fname'] . "</td>";
                echo "<td>" . $row['lname'] . "</td>";
                echo "<td>" . $row['mi'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['contact'] . "</td>";
                echo "<td><a rel='facebox' href='edit.php?id=" . $row['id'] . "'>Edit </a>| ";
                echo "<a rel='facebox' href='del.php?id=" . $row['id'] . "'>Del</td>";
                echo "</tr>";
            }
            echo "</table>";

            ?>

        </div>


    </div>

</body>

</html>
<script src="js/jquery.js"></script>
<script type="text/javascript">
    $(function () {


        $(".delbutton").click(function () {

            //Save the link in a variable called element
            var element = $(this);

            //Find the id of the link that was clicked
            var del_id = element.attr("id");

            //Built a url to send
            var info = 'id=' + del_id;
            if (confirm("Sure you want to delete this update? There is NO undo!")) {

                $.ajax({
                    type: "GET",
                    url: "delete.php",
                    data: info,
                    success: function () {

                    }
                });
                $(this).parents(".record").animate({
                        backgroundColor: "#fbc7c7"
                    }, "fast")
                    .animate({
                        opacity: "hide"
                    }, "slow");

            }

            return false;

        });

    });
</script>