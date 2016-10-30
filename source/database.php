<?php
  // Define database connection constants
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASSWORD','');
  define('DB_NAME', 'account');
  define('SERVER', 'http://'. (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost'));
  define('PORT',isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : '80');
?>
