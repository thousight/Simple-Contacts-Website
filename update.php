<html>
<body>

<form method="post">
Name: <input type="text" name="Name"><br>
Phone Number: <input type="text" name="Number"><br>
<input type="submit">
</form>
    
<?php 
    session_start();
// Handling when the form isn't filled or isn't filled completely
if (empty($_POST["Name"]) || empty($_POST["Number"])){
    echo "Please enter name and phone number";
}

// When the form is filled, post all the variables and store them.
else {   
    $name = $_POST["Name"];
    $number = $_POST["Number"];
    $sql = "UPDATE contacts SET Numbers='" . $number . "' WHERE Name='" . $name . "'";// Creating SQL add statement
    $connect = new mysqli("localhost", $_SESSION["username"],         $_SESSION["password"], "schema"); // Using session to create a new connection
    
// Update data to mysql in the if statement and show results
if ($connect->query($sql) === true) {
    echo "Success";
}
else {
    echo "Fail: " . $connect->error;
}
}
?>

</body>
</html>