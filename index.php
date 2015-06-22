<html>
<body>

    <?php
        session_start();
    ?>
    
<form method="post">
username: <input type="text" name="username"><br>
password: <input type="password" name="password"><br>
<input type="submit">
</form>

    
    <?php 
if (empty($_POST["username"]) || empty($_POST["password"])){
    echo "Please enter username and password";
}
else {
        $_SESSION["username"] = $_POST["username"]; 
        $_SESSION["password"] = $_POST["password"]; 
        $connect = new mysqli("localhost", $_SESSION["username"], $_SESSION["password"], "schema");
        if ($_SESSION["connect"]->connect_error) {
            die("Can't connect: " . $_SESSION["connect"]->connect_error);
        }
        echo "You are in!";
    ?>
    <FORM METHOD="LINK" ACTION="add.php" TARGET = "_blank">
    <INPUT TYPE="submit" VALUE="Add Contact">
    </FORM>

    <FORM METHOD="LINK" ACTION="search.php" TARGET = "_blank">
    <INPUT TYPE="submit" VALUE="Search or Delete Contact">
    </FORM> 
        
    <FORM METHOD="LINK" ACTION="update.php" TARGET = "_blank">
    <INPUT TYPE="submit" VALUE="Update Contact Number">
    </FORM> 
    <?php
}
?>

</body>
</html>