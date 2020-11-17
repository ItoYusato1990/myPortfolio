<?php
try {
  $db = new PDO('mysql:dbname=mybooks;host=localhost;charset=utf8', 'root', 'root');
} catch(PDOExeption $e) {
  print('DB接続エラー : ' . $e->getMessage());
}