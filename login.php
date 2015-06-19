<html>
<body>
    
    <?php 
    session_start();
        $_SESSION["username"] = $_POST["username"]; 
        $_SESSION["password"] = $_POST["password"]; 
        $connect = new mysqli("localhost", $_SESSION["username"], $_SESSION["password"], "schema");
        if ($_SESSION["connect"]->connect_error) {
            die("Can't connect: " . $_SESSION["connect"]->connect_error);
        }
        echo "You are in!";
    ?>
    
    <FORM METHOD="LINK" ACTION="add.php">
    <INPUT TYPE="submit" VALUE="Add Contact">
    </FORM> 

    <FORM METHOD="LINK" ACTION="search.php">
    <INPUT TYPE="submit" VALUE="Search or Delete Contact">
    </FORM> 
        
    <FORM METHOD="LINK" ACTION="update.php">
    <INPUT TYPE="submit" VALUE="Update Contact Number">
    </FORM> 
    
</body>
</html>