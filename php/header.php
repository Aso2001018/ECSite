<?php
session_start();
if(!isset($_SESSION['login'])){   $_SESSION['login'] = false;}
if(!isset($_SESSION['user'])){    $_SESSION['user'] = 'Guest';}
if(!isset($_SESSION['user_id'])){ $_SESSION['user_id']=-1;}
//ファイル名の取得
$txt_name = basename(debug_backtrace()[0]["file"], ".php");
$title_name = '';
//ページタイトルの設定
switch($txt_name){
case'cart':// ! IS LOGIN > LOGIN
  $title_name = 'カート';
  if (!$_SESSION['login']) {
    http_response_code(301);
    header("Location: ./login.php");
    exit;
  }
  break;
case'customize':// ! IS LOGIN > LOGIN
  $title_name = 'カスタマイズ';
  if (!$_SESSION['login']) {
    http_response_code(301);
    header("Location: ./login.php");
    exit;
  }
  break;
case'fav':// ! IS LOGIN > INDEX
  $title_name = 'お気に入り';
  if (!$_SESSION['login']) {
    http_response_code(301);
    header("Location: ./index.php");
    exit;
  }
  break;
case'index':
  $title_name = 'トップ';
  break;
case'info':// ! IS LOGIN > INDEX
  $title_name = '会員情報';
  if (!$_SESSION['login']) {
    http_response_code(301);
    header("Location: ./index.php");
    exit;
  }
  break;
case'login':// IS LOGIN > INDEX
  $title_name = 'ログイン';
  if ($_SESSION['login']) {
    http_response_code(301);
    header("Location: ./index.php");
    exit;
  }
  break;
case'search':
  $title_name = '検索結果';
  break;
case'signup':// IS LOGIN > INDEX
  $title_name = '新規会員登録';
  if ($_SESSION['login']) {
    http_response_code(301);
    header("Location: ./index.php");
    exit;
  }
  break;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?= $title_name ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>
</title>
<link rel="stylesheet"href="../css/sanitize.css">
<link rel="stylesheet"href="../css/style.css">
<link rel="stylesheet"href="../css/<?=$txt_name?>.css">
<link rel="stylesheet"href="../css/item.css">
<script>var islogin = <?php if($_SESSION['login'])echo'true';else echo'false';?>;</script>
<script language="javascript"src="../script/shortcuts.js"></script>
<script language="javascript"src="../script/<?=$txt_name?>.js"></script>
<script language="javascript"src="../script/all.min.js"></script>
</head>
<body>
<header>
  <div class="top_line">
    <h1><a href="index.php">TITLE</a></h1>
    <form action="search.php"method="get" class="glass">
      <input type="text"name="s_keyword"class="search"placeholder="何をお探しですか？">
      <button type="submit"><i class="fas fa-search"></i></button><span>検索</span>
    </form>
  </div>
  <nav class="menu">
    <ul class="nav_menu2">
    <?php
if ($_SESSION['login']) {
  echo'<li class="nav_menu2_item"><a href="logout.php"><i class="fas fa-sign-out-alt"></i>ログアウト</a></li>';
  echo'<li class="nav_menu2_item"><a href="info.php"><i class="fas fa-user-circle"></i>会員情報</a></li>';
  echo'<li class="nav_menu2_item"><a href="fav.php"><i class="fas fa-heart"></i>お気に入り</a></li>';
  echo'<li class="nav_menu2_item"><a href="cart.php"><i class="fas fa-shopping-cart"></i>カート</a></li>';
}
else {
  echo'<li class="nav_menu2_item login"><a href="signup.php"><i class="fas fa-user-circle"></i>新規会員登録</a></li>';
  echo'<li class="nav_menu2_item"><a href="login.php"><i class="fas fa-sign-in-alt"></i>ログイン</a></li>';
}
?>
    </ul>
    <ul class="nav_menu3">
      <form method="get" action="search.php">
        <button name="Type" value="2" class="nav_menu3_item" type="submit">デスクトップPC</button>
        <button name="Type" value="3" class="nav_menu3_item" type="submit">ノートPC</button>
        <button name="Type" value="1" class="nav_menu3_item" type="submit">ゲーミングPC</button>
        <button name="Type" value="4" class="nav_menu3_item" type="submit">クリエイター向けPC</button>
      </form>
    </ul>
  </nav>
</header>
<div class="cont"id="cont">