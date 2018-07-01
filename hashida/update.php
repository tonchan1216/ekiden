<?php

// 投稿ボタンを押すとここに遷移してくる
// ここは簡単な”投稿されました！”って画面と”戻る”ボタンを作る
//   index.php に戻るボタンを作る

include('function.php');

try {
  // connect
  $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // もしフォームがPOSTされたら -> HTMLのPOSTメソッドと連動
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])){
  // NULLじゃないことを確認

    $name  = trim($_POST['name']);   // 文字列を抽出+空白削除
    $date  = trim($_POST['date']);   // 文字列を抽出+空白削除
    $min   = trim($_POST['min']);   // 文字列を抽出+空白削除
    $sec   = trim($_POST['sec']);   // 文字列を抽出+空白削除
    $place = trim($_POST['place']);  // 文字列を抽出+空白削除

    if($name !== ''){
      $name     = str_replace("\t", ' ', $name);
      $min      = str_replace("\t", ' ', $min);
      $sec      = ($sec < 10) ? ($sec = "0" + $sec) : $sec;
      $sec      = str_replace("\t", ' ', $sec);
      $date     = ($date === '') ? date('Y-m-d') : $date;
      $date     = str_replace("\t", ' ', $date);
      $place    = str_replace("\t", ' ', $place);

      update($db, $name, $min, $sec, $place, $date);

    }
  }    
}

catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}

//echo var_dump($db);

?>




<!DOCTYPE> <!-- ここにページ遷移してくる -->
<html>
<head> <!-- ヘッダ情報 -->
  <meta name ="author" content="tech togics">
  <meta name="description" content="ホームページ作成やWEBの基本といえばHTML">
  <meta name="keywords" content="tech logics,html,css">
  <meta name="generator" content="Sublime Text">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>アップロードが完了しました</title>

  <!-- 指定した秒数後にページをリロードさせることができる X秒後-->
  <!-- <meta http-equiv="refresh" content="60"> -->

  <!-- Bootstrap core CSS -->
  <link href="./css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <!-- <link rel="stylesheet" href="css/box.css" type="text/css"> -->
  <link type="text/css" rel="stylesheet" href="chrome-extension://pioclpoplcdbaefihamjohnefbikjilc/content.css">

  <!--7segment font -->
  <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/segment7" type="text/css"/>
</head>

<body>
  <div id="nav"></div>

  <div class="container check-window text-center">
  <h3>投稿は正常に行われました.</h3>
  <form action="./index.php">
    <input type="submit" class="backbutton" value="戻る">
  </form>
</div>
</body>

</html>


<script type="text/javascript" src="js/timer.js"></script>
<script src="http://code.jquery.com/jquery-1.10.1.min.js" ></script>
<script src="./js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/timer.js"></script>


<script>
   //ヘッダーとフッターを外部ファイルから読み込み
   $(function() {
    $("#nav").load("nav.php");
    $("#form").load("form.php");
    $("#pictures").load("pictures.php")
    $("#footer").load("footer.php");
   });
</script>



