<?php
require_once('../includes/database.php');
require_once('../includes/auth-functions.php');
require_once('../includes/pocket_money-functions.php');

session_start();
$user = checkAuth();

$currentPocketMoney = getPocketMoney($user['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['pocket_money']) && is_numeric($_POST['pocket_money'])) {
    $pocketMoney = (float)$_POST['pocket_money'];
    updatePocketMoney($user['id'], $pocketMoney);
    $currentPocketMoney = $pocketMoney;
  } else {
    $error = 'お小遣いの入力が正しくありません。';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>月額お小遣い設定｜ムビポケ</title>
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
        <h1 class="display-4 mb-4">月額小遣い編集</h1>
        <?php if (isset($error)): ?>
          <p class="text-danger"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="post" action="">
          <div class="mb-3">
            <label for="pocket_money" class="form-label">お小遣い額を入力 </label>
            <div class="row justify-content-center">
              <div class="col-md-6">
                <input type="text" class="form-control" id="pocket_money" name="pocket_money" value="<?= htmlspecialchars($currentPocketMoney) ?>">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">更新</button>
        </form>
        <p class="mt-3">現在の月額お小遣い: <?= htmlspecialchars($currentPocketMoney) ?>円</p>
        <p><a href="pocket_money.php" class="btn btn-secondary">お小遣い情報ページへ戻る</a></p>
        <p><a href="../index.php" class="btn btn-secondary">ホームページへ戻る</a></p>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
