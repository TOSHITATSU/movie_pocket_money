<?php
require_once 'database.php';

//会員登録データベース追加処理メソッド
function registerUser($name, $email, $password) {
  $pdo = connectDB();
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $sql = "INSERT INTO users (name, email, password, created_at, updated_at) VALUES (:name, :email, :password, NOW(), NOW())";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':name', $name, PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
  $stmt->execute();
}

//ユーザーの名前情報を取得メソッド
function getUserName($user_id) {
  $pdo = connectDB();
  $sql = "SELECT `name` FROM users WHERE id = :user_id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  return $user['name'];
}

//ログイン処理のデータベース情報取得メソッド
function loginUser($email, $password) {
  $pdo = connectDB();
  $sql = "SELECT * FROM users WHERE email = :email";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  $user = $stmt->fetch();
  //パスワード照合処理
  if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      return true;
  } else {
      return false;
  }
}

//ログイン状態チェックメソッド
function checkAuth() {
  if (!isset($_SESSION['user_id'])) {
      header('Location: login.php');
      exit;
  }

  return getUserById($_SESSION['user_id']);
}

function getUserById($userId) {
  $pdo = connectDB();

  $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
  $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
  $stmt->execute();

  return $stmt->fetch(PDO::FETCH_ASSOC);
}

//ユーザーのログイン状態確認メソッド
function isLoggedIn() {
  return isset($_SESSION['user_id']);
}
//ユーザーのログアウトメソッド
function logoutUser() {
  unset($_SESSION['user_id']);
}
