<html>
<body>


  <?php
  // Check if there is data from search.php, if so then paste them onto the form
  if (!empty($_POST["NameFromSearch"]) && !empty($_POST["NumberFromSearch"])) {
    ?>

    <form method="post">
      Name: <input type="text" name="Name" value = "<?php echo $_POST["NameFromSearch"] ?>"><br>
      Phone Number: <input type="text" name="Number" value = "<?php echo $_POST["NumberFromSearch"] ?>"><br>
      <input type="submit">
    </form>

    <?php
  }
  // If there is nothing from search.php or user opens this page directly
  else {
    ?>

    <form method="post">
      Name: <input type="text" name="Name"><br>
      Phone Number: <input type="text" name="Number"><br>
      <input type="submit">
    </form>

    <?php 
  }

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
