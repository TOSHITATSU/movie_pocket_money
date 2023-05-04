<?php
require_once 'database.php';
// データベースから、ログインしているユーザーのサブスクリプションの一覧を取得する関数
function getSubscriptionList($userId) {
  $pdo = connectDB();

  // Change this line
  $stmt = $pdo->prepare('SELECT * FROM subscriptions WHERE user_id = :user_id');
  $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
  $stmt->execute();
  
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// データベースに新しいサブスクリプションを追加する関数。
// ユーザーID、サブスクリプションの名前、サブスクリプションの金額を引数に取る。
// 引数のデータを使用して、subscriptionsテーブルに新しい行を追加する。
// 成功した場合は true を、失敗した場合は false を返す。
function addSubscription($userId, $name, $amount) {
  $pdo = connectDB();
  
  $stmt = $pdo->prepare('INSERT INTO subscriptions (user_id, name, amount, created_at, updated_at) VALUES (:user_id, :name, :amount, NOW(), NOW())');
  $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':amount', $amount, PDO::PARAM_INT); // 修正後
  
  return $stmt->execute();
}

//データベースからサブスクリプションを削除する関数
function deleteSubscription($subscriptionId, $userId) {
  $pdo = connectDB();
  
  $stmt = $pdo->prepare('DELETE FROM subscriptions WHERE id = :id AND user_id = :user_id');
  $stmt->bindParam(':id', $subscriptionId, PDO::PARAM_INT);
  $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
  
  return $stmt->execute();
}

// データベースから、ログインしているユーザーのサブスクリプションの総金額を取得する関数
function getTotalAmount($userId) {
  $pdo = connectDB();
  $stmt = $pdo->prepare('SELECT SUM(amount) as total_amount FROM subscriptions WHERE user_id = :user_id');
  $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetchColumn();
}
