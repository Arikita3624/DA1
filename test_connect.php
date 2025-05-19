<?php
  require_once './commons/env.php';
  require_once './commons/function.php';

  $conn = connectDB();

  if ($conn) {
    echo 'Connected successfully';
    $stmt = $conn->query('SELECT * FROM users');
    var_dump($stmt->fetchAll());
  } else {
    echo 'Connection failed';
  }

?>