<?php
require_once '../includes/database.php';
require_once '../includes/auth-functions.php';
require_once '../includes/subscription-functions.php';

session_start();

// ユーザーがログインしていない場合、ログインページにリダイレクト
if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $subscriptionId = $_POST['subscription_id'];
  $userId = $_SESSION['user_id'];

  if (deleteSubscription($subscriptionId, $userId)) {
      header('Location: subscriptions.php');
      exit;
  } else {
      echo "削除に失敗しました。";
  }
}


