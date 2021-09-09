<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$obj = $_POST['pattern'];

// ここに処理を記述してください。
$array = json_decode($obj, true);   //json形式の文字列を配列にデコード。
const MAX = 30;                     //出力する数値の最大値。

if (is_array($array["obj"])) {      //count()関数の引数で使う$array["obj"]が配列やオブジェクト以外だったときは、処理せずにエラー文を返す。（Warning回避）
    for($i = 1; $i <= MAX; $i++){   
        $flg = 0;                   //flgを設定
        for($j = 0; $j < count($array["obj"]); $j++){
            if ($i % $array["obj"][$j]["num"] == 0){    //出力する数値が、入力された"num"の倍数か判別する。
                echo " {$array["obj"][$j]["text"]}";
                $flg = 1;           
            }
        }
        if($flg == 0){              //flgが0ならそのまま数値を出力する。
            echo " {$i}";
        }
        if ($i != MAX) 
                echo ","; 
    }
} else {
    echo "入力が既定の配列ではありません。";    
}
?>