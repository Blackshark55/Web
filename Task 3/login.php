<?php
  // Define the premade password
  $password = '12345'; // Replace with a secure password

  // Check if the form has been submitted
  if (isset($_POST['password'])) {
    $input_password = $_POST['password'];

    // Check if the input password matches the premade password
    if ($input_password == $password) {
      // Set a session variable to indicate that the staff member is logged in
      session_start();
      $_SESSION['staff_logged_in'] = true;

      // Redirect to the staff page
      header('Location: staff.php');
      exit;
    } else {
      // Display an error message if the password is incorrect
      $error = 'Invalid password';
    }
  }
?>

<!-- Display the login form -->
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="staff.css"> 
</head>
<body>
  <div class="staff-login">
    <h2>Staff Login</h2>
    <form action="login.php" method="post">
      <label for="password">Password:</label>
      <input type="password" id="password" name="password">
      <input type="submit" value="Login">
      <?php if (isset($error)) { echo '<p style="color: red;">' . $error . '</p>'; } ?>
    </form>
  </div>
</body>
</html>