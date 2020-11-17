<?php
session_start();

if (!empty($_POST)) {
  $email = $_POST['email'];
  // メールアドレスとパスワードが入力されていたら
  if ($_POST['email'] !== '' && $_POST['pass'] !== '') {
    $login = $db->prepare('SELECT * FROM members WHERE email=? AND password=?');
    $login->execute(array(
      $_POST['email'],
      sha1($_POST['pass'])
    ));
    $member = $login->fetch();

    // ログインに成功した場合
    if ($member) {
      $_SESSION['email'] = $member['email'];
      $_SESSION['time'] = time();
      
      // 次回から自動でログインするにチェックが入っていた場合
      if ($_POST['save'] === 'on') {
        // クッキーにメールアドレスを保存(2週間)
        setcookie('email', $_POST['email'], time()+60*60*24*14);
      }
      header('Location: ../index.php');
      exit();
    } else {
      $error['login'] = 'failed';
    }
  } else {
    $error['login'] = 'blank';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
  <link rel="stylesheet" href="../css/user_login.css">
</head>
<body>
  <div class="container">
    <div class="imgBx">
      <img src="../images/notebook.jpg">
    </div>

    <div class="loginBox">
      <h3>ログイン</h3>
      <form action="" method="post">
        <!-- 名前入力 -->
        <div class="inputBox">
          <span><i class="fas fa-envelope"></i></span>
          <input type="text" name="email" placeholder="メールアドレス" value="<?php print(htmlspecialchars($email, ENT_QUOTES)); ?>">
          <?php if ($error['login'] === 'blank'): ?>
            <p class="error">*メールアドレスとパスワードを入力して下さい</p>
          <?php endif; ?>
          <?php if ($error['login'] === 'failed'): ?>
            <p class="error">ログインに失敗しました。正しくご記入下さい</p>
          <?php endif; ?>
        </div>
        <!-- パスワード入力 -->
        <div class="inputBox">
          <span><i class="fa fa-lock"></i></span>
          <input type="password" name="pass" placeholder="パスワード" value="<?php print(htmlspecialchars($_POST['pass'], ENT_QUOTES)); ?>">
        </div>
        
          
          <label for="save">次回からは自動的にログインする</label>
          <input id="save" type="checkbox" name="save" value="on">
        
          <input type="submit" name="" value="ログイン">
          <a href="new_registration.php">新規登録はこちら</a>
      </form>
    </div>
  </div>
</body>
</html>




