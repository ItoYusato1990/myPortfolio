<?php
session_start();
// require('../dbconnect.php');

// $_SESSION['join']が空の場合
// if (!isset($_SESSION['join'])) {
//   header('Location: ../index.php');
//   exit();
// }

// 登録ボタンが押された時POSTの中身が空でなければDBに値を保存する
if (!empty($_POST)) {
  $statement = $db->prepare('INSERT INTO members SET name=?, email=?, password=?, created=NOW()');
  $statement->execute(array(
    $_SESSION['join']['name'],
    $_SESSION['join']['email'],
    sha1($_SESSION['join']['pass'])
  ));
    $_COOKIE['email'] = $_SESSION['join']['email'];
    $_SESSION['time'] = time();
  // セッションを破棄
  header('Location: thanks.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>入力確認画面</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/user_info_confirm.css">
</head>
<body>
  <div class="wrapper">
    <h2 style="margin-top: 0px;">確認画面</h2>
      <form action="" method="post">
        <input type="hidden" name="action" value="submit">
        <p>記述した内容を確認して、【登録する】ボタンをクリックして下さい。</p>
        <div id="name"><i class="fa fa-user"><span> ユーザー名 : <?php print(htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES)); ?></span></i></div>
        <div id="email"><i class="fas fa-envelope"><span> メールアドレス : <?php print(htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES)); ?></span></i></div>
        <div id="pass"><i class="fa fa-lock"><span> パスワード : 【表示されません】 </span></i></div>
        <a class="btn btn-primary mt-3" href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a>
        <input class="btn btn-success mt-3 ml-2" type="submit" value="登録する"></input>
      </form>
  </div>
</body>
</html>