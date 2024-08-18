<?php
// Define the premade password
$password = '12345';

// Check if the form has been submitted
if (isset($_POST['submit'])) {
  // Get the input password
  $input_password = $_POST['password'];

  // Check if the input password matches the premade password
  if ($input_password == $password) {
    // Login successful, set a session variable
    session_start();
    $_SESSION['staff_logged_in'] = true;
    header('Location: staff.php');
    exit;
  } else {
    $error = 'Invalid password';
  }
}

// Display the login form
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <label for="password">Password:</label>
  <input type="password" id="password" name="password"><br><br>
  <input type="submit" name="submit" value="Login">
  <?php if (isset($error)) { echo '<p style="color: red;">' . $error . '</p>'; } ?>
</form>