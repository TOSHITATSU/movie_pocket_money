<?php
session_start();
require_once '../includes/auth-functions.php';
require_once '../includes/subscription-functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$subscriptions = getSubscriptionList();
$totalAmount = getTotalAmount($_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>サブスクリプション一覧 ｜ムビポケ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css_js/home.css">
</head>
<body>
  <div class="video-background">
  <video src="../images/映画フィルム上下.mp4" autoplay muted loop playsinline></video>
  </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mt-5">サブスクリプション一覧</h1>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>金額</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subscriptions as $subscription) : ?>
                            <?php if (isset($deletedSubscriptionId) && $subscription['id'] == $deletedSubscriptionId) continue; ?>
                            <tr>
                                <td><?= htmlspecialchars($subscription['name'] ?? '0') ?></td>
                                <td><?= htmlspecialchars($subscription['amount'] ?? '0') ?>円</td>
                                <td>
                                    <form action="delete_subscription.php" method="post">
                                        <input type="hidden" name="subscription_id" value="<?= htmlspecialchars($subscription['id'] ?? '0') ?>">
                                        <input type="submit" class="btn btn-danger" value="削除">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p>サブスク合計金額: <?= htmlspecialchars($totalAmount ?? '0') ?>円</p>
                <p><a href="add_subscription.php" class="btn btn-primary">サブスクリプション追加</a></p>
                <p><a href="pocket_money.php" class="btn btn-info">お小遣い情報ページへ</a></p>
                <p><a href="index.php" class="btn btn-secondary">ホームへ戻る</a></p>
            </div>
        </div>
    </div>

  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
