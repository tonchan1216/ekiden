<?php

include('function.php');

try {
  // connect
  $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  select($db);  // DBに情報をFETCHしにいく

  // var_dump($place_arr);
  // var_dump($time_arr);

  // 配列の表示
  // $s=0;
  // foreach ($name_arr as $name_arr) {
  //   echo $date_arr[$s]."<br>\n";
  //   echo $name_arr.': '.$time_arr[$s].' ('.$place_arr[$s].')'."<br>\n";
  // }

} catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}

// echo var_dump($db);
