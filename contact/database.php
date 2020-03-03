<?php
  $host_name = 'db783817964.hosting-data.io';
  $database = 'db783817964';
  $user_name = 'dbo783817964';
  $password = '*Cookies1';
  $dbh = null;

  try {
    $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
  } catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
?>
