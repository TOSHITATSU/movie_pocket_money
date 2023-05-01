<?php
require_once '../includes/database.php';
require_once '../includes/auth-functions.php';
require_once '../includes/rental-functions.php';
require_once '../includes/pocket_money-functions.php';
require_once '../includes/subscription-functions.php';

session_start();
$userId = isLoggedIn();
if (!$userId) {
  header('Location: login.php');
  exit;
}

$remainingAmount = getPocketMoney($userId) - getTotalAmount($userId);
$rentalResults = calculateRentals($remainingAmount);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>レンタル計算結果｜ムビポケ</title>
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
        <h1 class="display-4 mb-4">レンタル計算結果</h1>
        <p>残りのお小遣い: <?php echo htmlspecialchars(number_format($remainingAmount, 0)); ?>円</p>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>プロバイダー</th>
                <th>プラン</th>
                <th>借りられる映画の数</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rentalResults as $provider => $providerResult): ?>
                <?php foreach ($providerResult as $plan => $rentalCount): ?>
                  <tr>
                    <td><?php echo htmlspecialchars($provider); ?></td>
                    <td><?php echo htmlspecialchars($plan); ?></td>
                    <td><?php echo htmlspecialchars($rentalCount); ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <p><a href="subscriptions.php" class="btn btn-secondary">サブスクリプション一覧に戻る</a></p>
        <p><a href="pocket_money.php" class="btn btn-secondary">お小遣い情報に戻る</a></p>
        <p><a href="index.php" class="btn btn-secondary">ホームに戻る</a></p>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
