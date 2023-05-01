<?php
session_start();
require_once '../includes/auth-functions.php';
require_once '../includes/subscription-functions.php';

if (!isLoggedIn()) {
  header('Location: login.php');
  exit;
}

$subscriptionOptions = [
  'U-NEXT' => 2189,
  'Netflix ベーシック' => 990,
  'Netflix スタンダード' => 1480,
  'Netflix プレミアム' => 1980,
  'Amazonプライム・ビデオ' => 500,
  'Disney+' => 990,
  'Hulu' => 1026,
  'dTV' => 550,
  'TSUTAYA TV' => 1026,
  'd-アニメストア' => 440,
  'ABEMAプレミアム' => 960,
  'Apple TV+' => 660
];

// 提供されているサブスクリプションの選択肢と価格が含まれる$subscriptionOptions配列をループし、チェックボックスとラベルを生成します。フォームが送信された場合は、選択されたサブスクリプションのリストを取得して、データベースにサブスクリプションを追加します。追加に成功した場合は、サブスクリプション一覧ページにリダイレクトします。
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $selectedSubscriptions = json_decode($_POST['subscriptions'], true);

  foreach ($selectedSubscriptions as $subscription) {
    list($subscriptionName, $amount) = explode(':', $subscription);
    $amount = (int)$amount;

    if (!addSubscription($_SESSION['user_id'], $subscriptionName, $amount)) {
      echo "サブスクリプションの追加に失敗しました。";
      exit;
    }
  }

  header('Location: subscriptions.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>サブスクリプションを追加 | 映画お小遣いアプリ</title>
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
      <h1 class="display-4 mb-4">サブスクリプションを追加しよう</h1>
      <form action="" method="post" id="subscription-form" class="mt-4">
        <div>サブスクリプション名:</div>
        <?php foreach ($subscriptionOptions as $name => $price) : ?>
          <div class="form-check form-check-inline mb-3">
            <input class="form-check-input" type="checkbox" value="<?=htmlspecialchars($name) ?>: <?= htmlspecialchars($price) ?>" id="<?= htmlspecialchars($name) ?>-<?= htmlspecialchars($price) ?>">
            <label class="form-check-label mx-2" for="<?= htmlspecialchars($name) ?>-<?= htmlspecialchars($price) ?>">
              <?= htmlspecialchars($name) ?> (<?= htmlspecialchars($price) ?>円)
            </label>
          </div>
        <?php endforeach; ?>
        <br>
        <input type="hidden" name="subscriptions" id="subscriptions">
        <input type="submit" value="追加" class="btn btn-primary">
      </form>
      <p><a href="subscriptions.php" class="btn btn-secondary mt-3">サブスクリプション一覧に戻る</a></p>
    </div>
  </div>
</div>

<script src="./css_js/add_subscription.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>


