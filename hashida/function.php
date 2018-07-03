
<?php

// このディレクトリで諸々の関数を定義する...

// PDO(PHP Data Object)
define('DB_DATABASE', 'it_is_blog');
define('DB_USERNAME', 'blog');
define('DB_PASSWORD', 'Jzd5dNNH');
// PDOの接続するためのDSN(Data Source Name)
define('PDO_DSN', 'mysql:dbhost=localhost;dbname='.DB_DATABASE);


$num = 123;
$name_arr = array();
$min_arr = array();
$sec_arr = array();
$date_arr = array();
$place_arr = array();

// CSRF 対策
session_start();

function order($db){
   $stmt = $db-> query("select * from record order by date desc");  //全体抽出
  // $stmt->execute();
  $users= $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
  foreach ($users as $user){
    // $user->show();
    $user->store();
  }
}

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

// User クラス：fetchAllをする時に必要になるンゴ...
class User{

  public function store(){
    global $name_arr,$min_arr,$sec_arr,$date_arr,$place_arr;
    array_push($name_arr, $this->name);
    array_push($min_arr, $this->min);
    array_push($sec_arr, $this->sec);
    array_push($date_arr, $this->date);
    array_push($place_arr, $this->place);
  }
  public function show(){
    echo "$this->date";
    echo nl2br("\n");  //<br />タグ(改行タグ)が挿入される。
    echo "$this->name $this->min $this->sec ($this->place)";
    echo nl2br("\n");  //<br />uグ(改行タグ)が挿入される。
  }
}

function update($db, $name, $min, $sec, $place, $date){
  $stmt=$db->prepare("insert into record (name,min,sec,place,date) values (:name,:min,:sec,:place,:date)");

  $params = array(
    ':name'=>$name,':min'=>$min,':sec'=>$sec,':place'=>$place,':date'=>$date);

  $stmt->execute($params);
}


// DBに情報をINSERT。。。
function insert($db){
  $stmt=$db->prepare("insert into record (name,min,sec,place,date) values (:name,:min,:sec,:place,:date)");


  $params1 = array(':name'=>'Boss',':min'=>14,':sec'=>59,':place'=>'Aobadai',':date'=>20180515);
  $params2 = array(':name'=>'Katoken',':min'=>15,':sec'=>01,':place'=>'Aobadai',':date'=>20180522);

  $stmt->execute($params1);
  $stmt->execute($params2);
}


// DBの情報をDELETE。。。
function delete($db){
  $stmt = $db->prepare("delete from record where name = :name");
  $stmt->execute([
    ':name'  => ':name'
  ]);

  $stmt = $db->prepare("delete from record where place = :place");
  $stmt->execute([
    ':place'  => 'Aobadai'  // 実質全部削除(笑)
  ]);
}

// DBの情報をSELECTしてSHOWする。。。
function select($db){
  $stmt = $db-> query("select * from record");  //全体抽出
  // $stmt->execute();
  $users= $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
  foreach ($users as $user){
    // $user->show();
    $user->store();  // Storeしておけばいつでも読みだせる
  }
 // echo $stmt->rowCount() . " records found.";
 // echo nl2br("\n");  //<br />タグ(改行タグ)が挿入される。
}


?>
