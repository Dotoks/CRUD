<?php
if (isset($_POST['submit'])) {
	require "./config.php";
	require "./common.php";

	try {
	  $connection = new PDO($dsn, $username, $password, $options);

	  $new_user = array(
		"model" => $_POST['model'],
		"pictureURL"  => $_POST['pictureURL'],
		"lasteditted" => $_POST['lasteditted']

		
	  );
	  $sql = sprintf(
		"INSERT INTO %s (%s) values (%s)",
		"users",
		implode(", ", array_keys($new_user)),
		":" . implode(", :", array_keys($new_user))
	);
	
	$statement = $connection->prepare($sql);
	$statement->execute($new_user);

	} catch(PDOException $error) {
	  echo $sql . "<br>" . $error->getMessage();
	}
  
  }
?>
   
   
   <?php include "templates/header.php"; ?><h2>Add a user</h2>
   <?php if (isset($_POST['submit']) && $statement) { ?>
  <?php echo escape($_POST['model']); ?> successfully added.
<?php } ?>
    <form method="post">
    	<label for="model">Model</label>
    	<input type="text" name="model" id="model">
    	<label for="pictureURL">Picture Url</label>
    	<input type="text" name="pictureURL" id="pictureURL">
    	<label for="lasteditted ">Last Editted</label>
    	<input type="text" name="lasteditted" id="lasteditted">
    	<input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">Back to home</a>

    <?php include "templates/footer.php"; ?>