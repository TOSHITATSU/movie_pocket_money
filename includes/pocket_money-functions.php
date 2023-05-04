<?php
//ユーザーIDを受け取り、そのユーザーのポケットマネー情報をデータベースから取得して返す
function getPocketMoney($userId) {
  $pdo = connectDB();
  $stmt = $pdo->prepare('SELECT pocket_money FROM users WHERE id = :id');
  $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetchColumn();
}


// ユーザーIDと更新したいポケットマネーの値を受け取り、そのユーザーのポケットマネー情報をデータベースで更新

function updatePocketMoney($userId, $pocketMoney) {
  $pdo = connectDB();
  $stmt = $pdo->prepare('UPDATE users SET pocket_money = :pocket_money WHERE id = :id');
  $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
  $stmt->bindValue(':pocket_money', $pocketMoney, PDO::PARAM_STR);
  $stmt->execute();
}
