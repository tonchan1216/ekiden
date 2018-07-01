<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-header">
    <div class="navbar-brand text-white">Kato Lab Ekiden</div>
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#gnavi">
      <span class="sr-only">メニュー</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
 
  <div id="gnavi" class="collapse navbar-collapse">
    <ul class="navbar-nav" id="nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">HOME</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="record.php">練習記録</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="news.php">ニュース</a>
      </li>
    </ul>
  </div>
</nav>


<!--うまくできない　現在のURLとhrefの中のリンクが同じときclassにactiveを追加-->
<!--
<script>
  (document).ready(function() {
        $('nav ul li a').each(function() {
                var activeUrl = location.pathname.split("/")[1];　// 2階層目
                var $href = $(this).attr('href').split("/")[1];　// 2階層目
                if ($href == activeUrl ) {
                        $(this).addClass("active");
                }
        });
});
</script>
-->