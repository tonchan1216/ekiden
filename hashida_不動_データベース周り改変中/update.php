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
  if($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['name'])){         // NULLじゃないことを確認

    $name  = trim($_POST['name']);   // 文字列を抽出+空白削除
    $date  = trim($_POST['date']);   // 文字列を抽出+空白削除
    $min  = trim($_POST['min']);   // 文字列を抽出+空白削除
    $sec  = trim($_POST['sec']);   // 文字列を抽出+空白削除
    $place = trim($_POST['place']);  // 文字列を抽出+空白削除

  if($name !== ''){
      $name     = str_replace("\t", ' ', $name);
      $min     = str_replace("\t", ' ', $min);
      $sec     = str_replace("\t", ' ', $sec);
      $date     = ($date === '') ? date('Y-m-d') : $date;
      $date     = str_replace("\t", ' ', $date);
      $place    = str_replace("\t", ' ', $place);

      update($db, $name, $min, $sec, $place, $date);

    }
  }    
}


} catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}

echo var_dump($db);

?>

<!DOCTYPE> <!-- ここにページ遷移してくる -->
<html>
    <head>
        <meta http-equiv="content-type" charset="utf-8">
        <title>Database Updated !!</title>
    </head>
    <body>
      <text>投稿は正常に行われました.</text>
        <form action="./index.php">
          <input type="submit" value="戻る">
        </form>
    </body>
</html>



