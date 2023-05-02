<?php
session_start();
require_once '../includes/auth-functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // バリデーション
  if (empty($name) || empty($email) || empty($password)) {
      $errorMessage = '入力が正しくありません。';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errorMessage = '有効なメールアドレスを入力してください。';
  } elseif (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
      $errorMessage = 'パスワードは最低8文字で、大文字・小文字・数字を含む必要があります。';
  } else {
    try {
    registerUser($name, $email, $password);
    $_SESSION['registration_success'] = true;
    header('Location: login.php');
    exit;
    } catch (PDOException $e) {
    $errorMessage = '登録に失敗しました。';
    }
  }
}

?>
      
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー登録 ｜ムビポケ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css_js/home.css">
</head>

<body>
  <div class="video-background">
  <video src="../images/映画フィルム上下.mp4" autoplay muted loop playsinline></video>
  </div>
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-6">
              <h1 class="text-center mt-5">ムービーポケットマネージャー</h1>
              <p class="text-center">ユーザー登録</p>

              <?php if (isset($errorMessage)): ?>
                  <div class="alert alert-danger"><?= $errorMessage ?></div>
              <?php endif; ?>

              <form action="register.php" method="post">
                  <div class="mb-3">
                      <label for="name" class="form-label">名前:</label>
                      <input type="text" name="name" id="name" class="form-control" required>
                  </div>
                  <div class="mb-3">
                      <label for="email" class="form-label">メールアドレス:</label>
                      <input type="email" name="email" id="email" class="form-control" required>
                  </div>
                  <div class="mb-3">
                      <label for="password" class="form-label">パスワード:</label>
                      <input type="password" name="password" id="password" class="form-control" required>
                  </div>
                  <div class="d-grid">
                      <button type="submit" class="btn btn-primary">登録</button>
                  </div>
              </form>

              <p class="text-center mt-3">既にアカウントをお持ちの方は<a href="login.php">こちら</a></p>
          </div>
      </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
