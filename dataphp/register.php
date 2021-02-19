<?php
require_once 'includes/header.php';
?>
<div>
  <h1> Register</h1>
  <p> Already have an account? <a href="login.php">Login</a></p>
  
  <form action="includes/register-inc.php" method="post">
  <input type="text" name="name" placeholder="name">
  <input type="password" name="pass" placeholder="pass">
  <input type="password" name="confirmpass" placeholder="confirm pass">
  <button type="submit" name="submit">Register</button>
  
  
  </form>
</div>
<?php
require_once 'includes/footer.php';
?>