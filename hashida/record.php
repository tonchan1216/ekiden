<?php

$dataFile = 'bbs.dat';
include('fetch.php');

// エスケープ関数
function h($s){
	return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}
?>

<html> <!-- ドキュメントタイプの宣言の時に使う -->

<head> <!-- ヘッダ情報 -->
	<meta name ="author" content="tech togics">
	<meta name="description" content="ホームページ作成やWEBの基本といえばHTML">
	<meta name="keywords" content="tech logics,html,css">
	<meta name="generator" content="Sublime Text">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>練習記録</title>

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
	<div id="nav"></div>

	<header>
		<div class="container-fluid title">
			<h2 class="text-white" style="color:#422161; font-size:50px; background:url(images/header.jpg) no-repeat center; overflow:hidden; white-space:nowrap; background-size: cover; padding-top:100px; padding-bottom:25px">&nbsp;練習記録</h2>
			<hr>
		</div>
	</header>


	<div class="container mb-3">
		<div class="row">
			<div class="col-12 col-md-6 colmn">
				<h2>&nbsp;練習記録</h2>
				<div id="form"></div>
			</div>

			<div class="col-12 col-md-6 colmn">
				<table>
					<tr><th>日付</th><th>名前</th><th>コース</th><th>タイム</th></tr>
					<?php if (count($name_arr)) : ?>
						<?php $s=0;  ?>
						<?php foreach ($name_arr as $name_arr): ?>
							<tr>
								<td><?php echo $date_arr[$s]; ?></td>
								<td><?php echo $name_arr; ?></td>
								<td><?php echo $place_arr[$s]; ?></td>
								<td><?php echo $min_arr[$s]; ?>分<?php echo $sec_arr[$s]; ?>秒</td>
							</tr>
							<?php $s++;  ?>
						<?php endforeach; ?>
						<?php else : ?> 
							<tr>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
						<?php endif; ?>
					</table>
				</div>
			</div>
		</div>


		<div id="footer"></div>


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
   	$("#footer").load("footer.php");
   });
</script>

</body bgcolor="#ffffff" text="#000000" link="#0000ff" vlink="#ff00ff" alink="#ff0000">
</html>