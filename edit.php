<?php
session_start();

include 'db.php';

// Check if the form is submitted
if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mi = $_POST['mi'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    
    // Check if the owner ID already exists
    $existingResult = mysqli_query($conn, "SELECT * FROM owners WHERE id = '$id'");
    $existingOwner = mysqli_fetch_array($existingResult);
    
    if ($existingOwner) {
        echo "Owner ID already exists. Please enter a different ID.";
        exit; // Stop further execution
    }
    
    // Insert the new user into the database
    $insertResult = mysqli_query($conn, "INSERT INTO owners (id, lname, fname, mi, address, contact) 
                                        VALUES ('$id', '$lname', '$fname', '$mi', '$address', '$contact')");
    
    if ($insertResult) {
        echo "Owner added successfully!";
    } else {
        echo "Error: Failed to add owner.";
    }
}
?>

<p><h1>Owners Update</h1></p>
<form method="post" action="editecex.php">
    <table width="342" border="0">
        <tr>
            <td width="107">Owners Id:</td>
            <td width="320"><input type="text" name="id" /></td>
        </tr>
        <tr>
            <td>Last Name:</td>
            <td><input type="text" name="lname" /></td>
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
            <td>Contact:</td>
            <td><input type="text" name="contact" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="save" value="Add Owner" /></td>
        </tr>
    </table>
</form>
