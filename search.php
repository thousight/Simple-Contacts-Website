<html>
<body>

<form method="post">
Name: <input type="text" name="Name"><br>
Phone Number: <input type="text" name="Number"><br>
<input type="submit">
</form>
    
<?php 
    session_start();
    $connect = new mysqli("localhost", $_SESSION["username"],           $_SESSION["password"], "schema"); // Using session to create a new connection
    $sql = '';
// Handling when the form isn't filled
if (empty($_POST["Name"]) && empty($_POST["Number"])){
    echo "Please enter name or phone number";
}

// Handling if one item is filled
elseif (!empty($_POST["Name"]) && empty($_POST["Number"])){
    $sql = "SELECT * FROM contacts WHERE Name = '" . $_POST["Name"] . "'";
}
elseif (empty($_POST["Name"]) && !empty($_POST["Number"])){
    $sql = "SELECT * FROM contacts WHERE Numbers = '" . $_POST["Number"] . "'";
}

// Handling if all fields are filled
else {   
    $sql = "SELECT * FROM contacts WHERE Name = '" . $_POST["Name"] . "' and Numbers = '" . $_POST["Number"] . "'";
}
  
// Add data to mysql in the if statement and show results
if (empty($_POST["Name"]) && empty($_POST["Number"])){
    echo "  ";
}
// Table handling
elseif ($connect->query($sql)->num_rows > 0) { 
    $result = $connect->query($sql);
?>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Delete</th>
        </tr>
    
<?php
    while ($row = $result->fetch_assoc()) {
?>
    
        <tr>
            <td><?php echo $row["ID"] ?></td>
            <td><?php echo $row["Name"] ?></td>
            <td><?php echo $row["Numbers"] ?></td>
            <td>
                
            <form METHOD="LINK" ACTION="add.php" TARGET = "_blank">
                <INPUT TYPE="submit" VALUE="Delete">
            </form>
                
            </td>
        </tr>
    
<?php
    }
?>
    
    </table>
    
<?php
}
else {
    echo "0 results";
}
?>

</body>
</html>