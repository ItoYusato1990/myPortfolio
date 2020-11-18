<?php
session_start();

$_SESSION['email'] = $_SESSION['join']['email'];

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <p>登録が完了しました。</p>
  <a href="../mybooks/mybooks_list.php">トップページへ</a>
</body>
</html>