<?php

if (!empty($_POST)) {
  if ($_POST['name'] === '') {
    $error['name'] = 'blank';
  }
  if ($_POST['email'] === '') {
    $error['email'] = 'blank';
  }
  if (strlen($_POST['pass']) < 4 ) {
    $error['password'] = 'length';
  }
  if ($_POST['pass'] === '') {
    $error['password'] = 'blank';
  }

  // アカウントの重複チェック
  // $member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
  // $member->execute(array($_POST['email']));
  // $record = $member->fetch();
  // // $_POST['email']があれば1、無ければ0が返ってくる
  // if ($record['cnt'] > 0) {
  //   $error['email'] = 'duplicate';
  // }

  // エラーが無ければ
  if (empty($error)) {
    $_SESSION['join'] = $_POST;
    header('Location: check.php');
  }
}
// 書き直すボタンを押された場合
if ($_REQUEST['action'] == 'rewrite' && isset($_SESSION['join'])) {
  $_POST = $_SESSION['join'];
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規登録</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
  <link rel="stylesheet" href="../css/new_registration.css">
</head>
<body>
  <div class="container">
    <div class="imgBx">
      <img src="../images/notebook.jpg">
    </div>

    <div class="loginBox">
      <h3>新規登録</h3>
      <form action="" method="post">
        <!-- 名前入力 -->
        <div class="inputBox">
          <span><i class="fa fa-user"></i></span>
          <input type="text" name="name" placeholder="ユーザー名" value="<?php print(htmlspecialchars($_POST['name'], ENT_QUOTES)); ?>">
          <?php if ($error['name'] === 'blank'): ?>
            <p class="error">*名前を入力して下さい</p>
          <?php endif; ?>
        </div>
        <!-- メールアドレス -->
        <div class="inputBox">
          <span><i class="fas fa-envelope"></i></span>
          <input type="text" name="email" placeholder="メールアドレス" value="<?php print(htmlspecialchars($_POST['email'], ENT_QUOTES)); ?>">
          <?php if ($error['email'] === 'blank'): ?>
            <p class="error">*メールアドレスを入力して下さい</p>
          <?php endif; ?>
          <?php if ($error['email'] === 'duplicate'): ?>
            <p class="error">*指定されたメールアドレスは既に使用されています。</p>
          <?php endif; ?>
        </div>
        <!-- パスワード入力 -->
        <div class="inputBox">
          <span><i class="fa fa-lock"></i></span>
          <input type="password" name="pass" placeholder="パスワード" value="<?php print(htmlspecialchars($_POST['pass'], ENT_QUOTES)); ?>">
          <?php if ($error['password'] === 'length'): ?>
            <p class="error">*パスワードを4文字以上で入力して下さい</p>
          <?php endif; ?>
          <?php if ($error['password'] === 'blank'): ?>
            <p class="error">*パスワードを入力して下さい</p>
          <?php endif; ?>
        </div>
          <input type="submit" value="登録">
          <a href="login.php">ログインはこちら</a>
      </form>
    </div>
  </div>
</body>
</html>
