<?php

$dataFile = 'bbs.dat';
include('fetch.php');  

// エスケープ関数
function h($s){
	return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

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

	<!--7segment font -->
	<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/segment7" type="text/css"/>
</head>




<body>
	<div id="nav"></div>
	<header>
		<div class="jumbotron">
			<div class="container">
				<h1>加藤研駅伝公式ページ</h1>
				<p>2018年度：電気系駅伝大会まであと、</p>
				<div class="counter" id="demo"></div>
			</div>
		</div>

	</header>

	<!-- 左半分(グリッドデザイン) -->
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6 colmn">
				<h2>&nbsp;練習記録</h2>
				<!-- ここでどういうアクションを取るかを規定 -->
				<!-- 今回はデータを更新したいので "post" を使う -->
				<!-- "もしフォームがPOSTされたら"ってのをPHP部分に作る -->
				<!-- POSTフォーム -->

				<div id="form"></div>
				
				<h2>&nbsp;投稿一覧(<?php echo count($name_arr); ?>件)</h2>
				<ul>
					<?php if (count($name_arr)) : ?>  <!-- $postがあるか：ある -->
					<?php $s=0;  ?>
					<?php foreach ($name_arr as $name_arr): ?>
						<li>
							<dt><?php echo $date_arr[$s]."<br>\n"; ?></dt>
							<dd><?php echo $name_arr. ':' .$min_arr[$s]. ':' .$sec_arr[$s]. '('.$place_arr[$s].')'."<br>\n"; ?></dd>
						</li>
						<?php $s++;  ?>
					<?php endforeach; ?>
					<?php else : ?>  <!-- $postがあるか：ない -->
					<li>まだ投稿はありません。</li>
				<?php endif; ?>
			</ul>
		</div>

		<!-- 右半分(グリッドデザイン) -->
		<div class="col-12 col-md-6 colmn">
			<div id="pictures"></div>
		</div>
	</div>
</div>

<div id="footer"></div>

<!-- <script type="text/javascript" src="example1.js"></script> -->
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


</body bgcolor="#ffffff" link="#0000ff" vlink="#ff00ff" alink="#ff0000">


<div></div> <!-- 基本的なブロック要素 -->

<section></section> <!-- 意味や機能のひとまとまりのこと -->

<article></article> <!-- 独立した記事のセクション -->

