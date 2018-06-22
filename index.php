<?php

$dataFile = 'bbs.dat';

// CSRF 対策
session_start();

function setToken(){
  //  推測されにくい文字列を作ればOK...
  $token = sha1(uniqid(mt_rand(), true));
  $_SESSION['token'] = $token;
}


function checkToken(){
  // セッションのトークンがあるか && 内容が一致してるか
  if(empty($_SESSION['token']) || ($_SESSION['token'] != $_POST['token'])){
    echo "不正なPOSTが行われました";
    echo $_SESSION['token'];
    echo "\n";
    echo $_POST['token'];
    exit;
  }
}


// エスケープ関数
function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}


// データ書き込み
// もしフォームがPOSTされたら -> HTMLのPOSTメソッドと連動
if($_SERVER['REQUEST_METHOD'] == 'POST' &&
  isset($_POST['message']) &&      // NULLじゃないことを確認
  isset($_POST['user'])){         // NULLじゃないことを確認

  checkToken();

  $message = trim($_POST['message']);  // 文字列を抽出+空白削除
  $user    = trim($_POST['user']);     // 文字列を抽出+空白削除
  $date    = trim($_POST['date']);     // 文字列を抽出+空白削除

if($message !== ''){

    $user     = ($user === '') ? 'Mr.nobody' : $user;
    $message  = str_replace("\t", ' ', $message);  // タブ(\t)を空白に置換
    $user     = str_replace("\t", ' ', $user);     // タブ(\t)を空白に置換
    $date     = str_replace("\t", ' ', $date);     // タブ(\t)を空白に置換
    $postedAt = date('Y-m-d');
    $newData  = $message."\t".$user."\t".$date."\t".$postedAt."\n";

    $fp       = fopen($dataFile, 'a');  // ファイルを開く
    fwrite($fp, $newData);              // ファイルに書き込み
    fclose($fp);                        // ファイルを閉じる
  }
} else {
  setToken();
}

// ファイルの情報を読み込んで表示の準備   
$posts = file($dataFile, FILE_IGNORE_NEW_LINES); // 一行づつ取り出し配列に
$posts = array_reverse($posts);                  // 配列の中身を逆順に

?>

<!DOCTYPE html> <!-- ドキュメントタイプの宣言の時に使う -->

<html> <!-- htmlの文書であるという宣言 -->

<head> <!-- ヘッダ情報 -->
  <meta name ="author" content="tech togics">
  <meta name="description" content="ホームページ作成やWEBの基本といえばHTML">
  <meta name="keywords" content="tech logics,html,css">
  <meta name="generator" content="Sublime Text">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>KatoLab Ekiden</title>

  <!-- 指定した秒数後にページをリロードさせることができる X秒後-->
  <!-- <meta http-equiv="refresh" content="60"> -->

  <!-- Bootstrap core CSS -->
  <link href="./css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <!-- <link rel="stylesheet" href="css/box.css" type="text/css"> -->
  <link type="text/css" rel="stylesheet" href="chrome-extension://pioclpoplcdbaefihamjohnefbikjilc/content.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-inverse navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">加藤研駅伝</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="jumbotron">
      <div class="container">
        <h1>加藤研駅伝公式ページ</h1>
        <p>2018年度：電気系駅伝大会まであと、</p>
        <div id="demo"></div>
      </div>
    </div>

  </header>

  <div class="container">
    <div class="row">
      <!-- 左半分(グリッドデザイン) -->
      <div class="col-sm-6">
        <h2>簡易掲示板</h2>
        <!-- ここでどういうアクションを取るかを規定 -->
        <!-- 今回はデータを更新したいので "post" を使う -->
        <!-- "もしフォームがPOSTされたら"ってのをPHP部分に作る -->
        <form action="" method="post">
          message: <input type="text" name="message">
          user: <input type="text" name="user">
          date: <input type="text" name="date">

          <input type="submit" value="投稿">
          <input type="hidden" name="token"
           value="<?php echo h($_SESSION['token']); ?>">
        </form>

        <h2>投稿一覧(<?php echo count($posts); ?>件)</h2>
        <ul>
          <?php if (count($posts)) : ?>  <!-- $postがあるか：ある -->
            <?php foreach ($posts as $post) : ?>
            <!-- 読み込み時にタブ区切りになってる$postを分割 -->
            <?php list($message,$user,$date,$postedAt) = explode("\t",$post); ?>
              <li>
                <dt> <?php echo h($date); ?> </dt>
                <dd> <?php echo h($user); ?>：<?php echo h($message); ?> </dd>
              </li>
            <?php endforeach; ?>
          <?php else : ?>                <!-- $postがあるか：ない -->
            <li>まだ投稿はありません。</li>
          <?php endif; ?>
        </ul>
      </div>

      <!-- 左半分(グリッドデザイン) -->
      <div class="col-sm-6">
        <h2>駅伝写真</h2>
        <div class="inner">
          <dl class="newlist">
            <dt>2018/05/13</dt>
            <dd>仙台ハーフマラソン
              <div class="grid_box affi2"> <!--アフィリエイト(幅1280px以下の場合に表示)-->
                <img src="images/pic2.jpg" alt="駅伝" style="width:300px; text-align:center"/>
              </div>
              <div class="grid_box"></div>

            <dt>2018/04/18</dt>
            <dd>新年度駅伝練習始動！！！
              <div class="grid_box affi2"> <!--アフィリエイト(幅1280px以下の場合に表示)-->
                <img src="images/pic1.jpg" alt="駅伝" style="width:300px; text-align:center"/>
              </div>
              <div class="grid_box"></div>
            </dd>
          </dl>
          <div class="grid2 first">〜終わり〜</div>
        </div>
      </div>
    </div>
  </div>


  <footer class="footer">
    <div class="container">
      <p class="text-muted">Place sticky footer content here.</p>
    </div>
  </footer>

  <script src="./js/jquery.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/timer.js"></script>
  <script>
    $(function(){

        //今日の日付データを変数hidukeに格納
        var hiduke=new Date(); 
        //年・月・日・曜日を取得する
        var year = hiduke.getFullYear();
        var month = hiduke.getMonth()+1;
        var week = hiduke.getDay();
        var day = hiduke.getDate();

        // focus, blur
        // change
        $('#name')
          .focus(function(){
            $(this).css('background', 'yellow')
          })
          .blur(function(){
            $(this).css('background', 'white')
          });
        $('#members').change(function(){
          alert('changed !!!')
        });

        // ボタンが押されるたびに<p>要素が動的に作られていく。。。
        // クリックイベントを設定
        // <dt>2018/05/17</dt>
        // <dd>河本雄一：14:59</dd>
        $('button' + '#add').click(function(){
          // var p = $('<p>').text('vanish!').addClass('vanish');
          // $(this).after(p)
          var dt = $('<dt>').text('2018/05/17').addClass('data');
          var dd = $('<dd>').text('河本雄一：14:59').addClass('name&time');
          $(this).after(dd)
          $(this).after(dt)
        })

        // 再度クリックで消えるようにする。onメソッドを使おう...
        // 動的に色々いじりたい時に"onメソッド"は必須ンゴ。。。
        $('body').on('click', '.vanish', function(){
          $(this).remove();
        });

        // Ajax(中級者向け)
        // Asynchronous JavaScript + XML
        // サーバと通信 + ページ(の一部)書き換え
        // Dotinstallの”完了”ボタン＋Yahooトップの”ニュース”切替とか

        $("p > input"+"#greet").click(function(){
          $.get('greet.php', {
            name: $('#name').val()
          }, function(data){
            var dt = $('<dt>').text(year+'/'+month+'/'+day).addClass('data');
            var dd = $('<dd>').text(data.message).addClass('name&time');
            $('.newlist1 > dd:eq(-1)').after(dt);
            $('.newlist1 > dt:eq(-1)').after(dd);
            // $('#output1').html(year+'/'+month+'/'+day);
            // $('#output2').html(data.message);
          });
        });

        $("button" + "#more").click(function(){
          $("#result").load("more.html")
        })

    });
  </script>
  <script type="text/javascript" language="javascript">
        function onButtonClick() {
          target = document.getElementById("output");
          target.innerText = document.forms.id_form1.id_textBox1.value;
        }
  </script>


<p>

<div></div> <!-- 基本的なブロック要素 -->

<section></section> <!-- 意味や機能のひとまとまりのこと -->

<article></article> <!-- 独立した記事のセクション -->

<text>Hello Hashida!</text>

<text>Hello Hashida2!</text>

</body>
