<?php

// set initial value of input field executes
$email = $title = $ingredients = '';

// store error messages
$errors = array('email' => '','title' => '', 'ingredients' => '');

// POST - send data url (not secure)
// if(isset($_POST['submit'])) {
//   echo $_POST["email"];
//   echo $_POST["title"];
//   echo $_POST["ingredients"];
// }

// POST - send data header (secure)
if(isset($_POST['submit'])) {
  // echo htmlspecialchars($_POST["email"]);
  // echo htmlspecialchars($_POST["title"]);
  // echo htmlspecialchars($_POST["ingredients"]);

  // Q[2] :CHECK IF FIELDS ARE EMPTY

  // 1: checks email field is not empty
  if(empty($_POST["email"])) {
    $errors["email"] = "An email is required <br />";
  }
  else 
  {
    $email =  $_POST["email"];
    // checks for valid email -> if email not valid the execute
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
      $errors["email"] = "An email must be a valid email address <br />";
    }
  }


   // 2: check title
   if(empty($_POST["title"])) {
    $errors["title"] =  "A title is required <br />";
  }
  else 
  {
    $title = $_POST["title"];
    if(!preg_match('/^[a-zA-Z\s]+$/', $title)) {
      $errors["title"] =  'Title must be letters and spaces only <br />';
    }
  }


   // 3: check ingredients
   if(empty($_POST["ingredients"])) {
    $errors["ingredients"] = "At least one ingredients is required <br />";
  }
  else 
  {
    $ingredients = $_POST["ingredients"];
    if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
      $errors["ingredients"] = 'Ingredients must be a comma separated list <br />';  
    }
  }

  // end of POST check

}



?>

<!DOCTYPE html>
<html lang="en">

  <?php include('templates/header.php'); ?>

  <section class="container grey-text">
    <h4 class="center">Add a Pizza</h4>
    <form action="add.php" class="white" method="POST">
      <label>Your Email:</label>
      <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
      <div class="red-text"><?Php echo $errors["email"]; ?></div>
      <label>Pizza Title:</label>
      <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
      <div class="red-text"><?Php echo $errors["title"]; ?></div>
      <label>Ingredients (comma separated):</label>
      <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
      <div class="red-text"><?Php echo $errors["ingredients"]; ?></div>
      <div class="center">
        <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
      </div>
  </form>
  </section>

  <?php include('templates/footer.php'); ?>
  
</body>
</html>