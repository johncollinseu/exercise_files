<?php

require_once('User.php'); 

$user_name = null; 

// Check for post
  if (!empty($_POST['name']))
  {
    $user_name = new User;
    $user_name->name = $_POST['name'];
    $user_name->addName();
  }

?>
<!doctype html>
<html lang="en">
    <head>
    </head>
    <body>
        <?php if (!empty($user_name->name)){ ?>

          <p>Hello <?php echo $user_name->name; ?>, hope you are well. </p>
          <p><a href="index.php">Back</a></p>

        <?php }else{ ?>
        
          <p>Hello, please enter your name below</p>

          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <p>
                  <label for="name">Name: </label>
                  <input type="text" name="name">
                  <input type="submit" name="submit" value="Submit">
              </p>
          </form>

        <?php } ?>
    </body>
</html>