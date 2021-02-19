<?php
require_once 'includes/header.php';
?>
<div>
  <h1> Log in</h1>
  <p> No account? <a href="register.php">Register here</a></p>
  
  <form action="includes/login-inc.php" method="post">
  <input type="text" name="name" placeholder="name">
  <input type="pass" name="pass" placeholder="pass">
  <button type="submit" name="submit">Login</button>
  
  
  </form>
</div>
<?php
require_once 'includes/footer.php';
?>