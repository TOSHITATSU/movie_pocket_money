<?php
require_once('../includes/database.php');
require_once('../includes/auth-functions.php');
require_once('../includes/pocket_money-functions.php');
require_once('../includes/subscription-functions.php');

session_start();
$user = checkAuth();

$pocketMoney = getPocketMoney($user['id']) ?? 0;
$totalAmount = getTotalAmount($user['id']) ?? 0;
$remainingAmount = $pocketMoney - $totalAmount;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>月額お小遣い情報｜ムビポケ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css_js/home.css">
</head>
<body>
  <div class="video-background">
  <video src="../images/映画フィルム上下.mp4" autoplay muted loop playsinline></video>
  </div>
  <div class="container d-flex h-100">
    <div class="row justify-content-center align-items-center w-100">
      <div class="col-md-8 text-center">
        <h1 class="display-4 mb-4">月額お小遣い情報</h1>
        <p class="lead">月額小遣い: <?php echo htmlspecialchars(number_format($pocketMoney, 0)); ?>円</p>
        <p class="lead">合計サブスクリプション料金: <?php echo htmlspecialchars(number_format($totalAmount, 0)); ?>円</p>
        <p class="lead">残りのお小遣い: <?php echo htmlspecialchars(number_format($remainingAmount, 0)); ?>円</p>
        <p><a href="edit_pocket_money.php" class="btn btn-primary">お小遣いを編集する</a></p>
        <p><a href="rental_calculator.php" class="btn btn-primary">レンタル計算を表示する</a></p>
        <p><a href="subscriptions.php" class="btn btn-primary">サブスクリプション一覧に戻る</a></p>
        <p><a href="index.php" class="btn btn-primary">ホームに戻る</a></p>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
