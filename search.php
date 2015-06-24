<html>
<body>

  <form method="post">
    Name: <input type="text" name="Name"><br>
    Phone Number: <input type="text" name="Number"><br>
    <input type="submit">
  </form>

  <?php
  session_start();
  $connect = new mysqli("localhost", $_SESSION["username"], $_SESSION["password"], "schema"); // Using session to create a new connection
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
          <td>
            <!-- Creating a button that redirects users to update.php with the selected item -->
            <FORM METHOD="POST" action = "update.php">
              <input TYPE = "hidden" name = "NameFromSearch" value = "<?php echo $row["Name"]?>">
              <input TYPE = "hidden" name = "NumberFromSearch" value = "<?php echo $row["Numbers"]?>">
              <INPUT TYPE = "submit" VALUE = "<?php echo $row["ID"]; ?>">
              </FORM>
            </td>
            <td><?php echo $row["Name"] ?></td>
            <td><?php echo $row["Numbers"] ?></td>
            <td>
              <!-- Creating a Delete button -->
              <FORM METHOD="POST" onclick = "return confirm('Are you sure to delete <?php echo $row["Name"]?>?');">
                <input TYPE = "hidden" name = "DeleteSQL" value = "DELETE FROM schema.contacts WHERE ID = <?php echo $row["ID"];?>">
                <input TYPE = "hidden" name = "DeletedName" value = "<?php echo $row["Name"]?>">
                <INPUT TYPE = "submit" VALUE = "Delete">
                </FORM>
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

      //Deleting data
      if (empty($_POST["DeleteSQL"]) && empty($_POST["DeletedName"])){
        echo "  ";
      }
      elseif ($connect->query($_POST["DeleteSQL"]) === TRUE) {
        echo "<br>" . $_POST["DeletedName"] . " is deleted successfully";
      } else {
        echo $_POST["DeleteSQL"];
        echo "Error deleting record: " . $connect->error;
      }
      ?>

    </body>
    </html>
