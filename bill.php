<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo '<script>window.location="index.php";</script>';
}
?>
<?php
$session = $_SESSION['id'];
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM user WHERE id='$session'");
while ($row = mysqli_fetch_array($result)) {
    $sessionname = $row['name'];
}
?>

<p style="color:#F00; font-size:20px;">Welcome <?php echo $sessionname; ?>!</p>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xht>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="lib/jquery.js" type="text/javascript"></script>
    <script src="src/facebox.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('a[rel*=facebox]').facebox({
                loadingImage: 'src/loading.gif',
                closeImage: 'src/closelabel.png'
            });
        });
    </script>
    <script src="js/application.js" type="text/javascript" charset="utf-8"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Web Application for Water Consumption in CPSU Main Campus</title>
    <style type="text/css">
        #wrapper {
            height: 500px;
            width: 900px;
            margin: 0 auto;
            position: relative;
            border: 3px solid rgba(0,0,0,0);
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 0 18px rgba(0,0,0,0.4);
            -moz-box-shadow: 0 0 18px rgba(0,0,0,0.4);
            box-shadow: 0 0 18px rgba(0,0,0,0.4);
            margin-top: 2%;
            background-color: green;
        }

        #header {
            width: 900px;
            height: 60px;
            background-color: lightgray;
        }

        #content table {
            margin: 100 auto;
        }

        #header ul li {
            list-style: none;
            float: left;
            margin-top: 30px;
            margin-left: 10px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
<br />
<div id="wrapper">
    <div id="header">
        <ul>
            <li><a href="billing.php">Home</a></li>
            <li><a href="bill.php">Billing</a></li>
            <li><a href="user.php">Users</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div id="content">
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
            echo "<td><a rel='facebox' href='paybill.php?id=" . $row['id'] . "'>Bill </a>| ";
            echo "<a rel='facebox' href='viewbill.php?id=" . $row['id'] . "'>View Bill</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
</div>

<script src="js/jquery.js"></script>
<script type="text/javascript">
    $(function() {
        $(".delbutton").click(function() {
            // Save the link in a variable called element
            var element = $(this);

            // Find the id of the link that was clicked
            var del_id = element.attr("id");

            // Build a url to send
            var info = 'id=' + del_id;
            if (confirm("Sure you want to delete this update? There is NO undo!")) {
                $.ajax({
                    type: "GET",
                    url: "delete.php",
                    data: info,
                    success: function() {

                    }
                });
                $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
                    .animate({ opacity: "hide" }, "slow");
            }

            return false;
        });
    });
</script>
</body>
</html>