<?php
//データベース接続情報
$dsn = 'mysql:host=localhost;dbname=movie_pocket_money;charset=utf8mb4';
$user = 'root';
$password = 'root';

try {
  $pdo = new PDO($dsn, $user, $password, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
} catch (PDOException $e) {
  echo 'Database connection failed: ' . $e->getMessage();
}
