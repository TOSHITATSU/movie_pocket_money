<?php
session_start();
require_once './includes/auth-functions.php';

if (!isLoggedIn()) {
    header('Location: ./public/login.php');
    exit;
}

$username = getUserName($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ホーム｜ムビポケ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./public/css_js/home.css">
</head>

<body>
  <div class="video-background">
  <video src="./images/映画フィルム上下.mp4" autoplay muted loop playsinline></video>
  </div>
  <div class="container text-center">
    <h1 class="mt-5">ムービーポケットマネージャー</h1>
    <p>ようこそ<?php echo htmlspecialchars($username ?? ''); ?>さん</p>
    <p>ここは映画マニアのお財布を救世主となるアプリ！
      <br>お小遣いを上手に使って、映画を楽しみつつ、破産の悲劇からあなたを守ります！
    </p>
    <nav class="mt-4">
      <ul class="nav justify-content-center">
        <li class="nav-item"><a href="./public/subscriptions.php" class="nav-link btn02 rotateback"><span>サブスクリプション一覧</span><span>あなたの加入状況を確認</span></a></li>
        <li class="nav-item"><a href="./public/add_subscription.php" class="nav-link btn02 rotateback"><span>サブスクリプション追加</span><span>登録したサブスクを管理しよう</span></a></li>
        <li class="nav-item"><a href="./public/pocket_money.php" class="nav-link btn02 rotateback"><span>お小遣い情報</span><span>月々に使える金額を確認</span></a></li>
        <li class="nav-item"><a href="./public/edit_pocket_money.php" class="nav-link btn02 rotateback"><span>お小遣い編集</span><span>月額の予算を決めよう</span></a></li>
        <li class="nav-item"><a href="./public/logout.php" class="nav-link btn02 rotateback"><span>ログアウト</span><span>帰っちゃうの？</span></a></li>
      </ul>
    </nav>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>