function set2fig(num) {
   // 数値が1桁だったら2桁の文字列にして返す
   var ret;
   if( num < 10 ) { ret = "0" + num; }
   else { ret = num; }
   return ret;
}
function isNumOrZero(num) {
   // 数値でなかったら0にして返す
   if( isNaN(num) ) { return 0; }
   return num;
}

function showCountdown() {
   // 現在日時を数値(1970-01-01 00:00:00からのミリ秒)に変換
   var nowDate = new Date();
   var dnumNow = nowDate.getTime();
 
   // 指定日時を数値(1970-01-01 00:00:00からのミリ秒)に変換
   var inputYear  = 2018;
   var inputMonth = 11 - 1;
   var inputDate  = 10;
   var inputHour  = 9;
   var inputMin   = 0;
   var inputSec   = 0;
   var targetDate = new Date( isNumOrZero(inputYear), isNumOrZero(inputMonth), isNumOrZero(inputDate), isNumOrZero(inputHour), isNumOrZero(inputMin), isNumOrZero(inputSec) );
   var dnumTarget = targetDate.getTime();
 
   // 表示を準備
   var dlYear  = targetDate.getFullYear();
   var dlMonth = targetDate.getMonth() + 1;
   var dlDate  = targetDate.getDate();
   var dlHour  = targetDate.getHours();
   var dlMin   = targetDate.getMinutes();
   var dlSec   = targetDate.getSeconds();
   
 

   // 引き算して日数(ミリ秒)の差を計算
   var diff2Dates = dnumTarget - dnumNow;
 
   // 差のミリ秒を、日数・時間・分・秒に分割
   var days  = diff2Dates / ( 1000 * 60 * 60 * 24 );   // 日数
   diff2Dates = diff2Dates % ( 1000 * 60 * 60 * 24 );
   var hours  = diff2Dates / ( 1000 * 60 * 60 );   // 時間
   diff2Dates = diff2Dates % ( 1000 * 60 * 60 );
   var minutes   = diff2Dates / ( 1000 * 60 );   // 分
   diff2Dates = diff2Dates % ( 1000 * 60 );
   var seconds   = diff2Dates / 1000;   // 秒
   var m_sec   = diff2Dates % 1000;

      if( m_sec >= 100){
      dmsec = m_sec;
   }
   else{
      dmsec = "0" + m_sec;
   }

   var time = Math.floor(days) + "日 "
            + Math.floor(hours) + "時間 "
            + Math.floor(minutes) + "分 "
            + Math.floor(seconds) + "秒 "
            + dmsec;
 

 //  // 表示文字列の作成
 //  var disp;
 //  if( dnumTarget > dnumNow ) {
 //     // まだ期限が来ていない場合
 //     document.getElementById("demo").innerHTML = "2018年度電気系駅伝大会まであと";
 //     document.getElementById("demo").innerHTML = time;
 //  }
 //  else {
 //     // 期限が過ぎた場合
 //     msg = msg1 + "は、既に" + msg2 + "前に過ぎました。";
 //  }

   // 作成した文字列を表示
   document.getElementById("demo").innerHTML = time;
}

setInterval('showCountdown()', 1);