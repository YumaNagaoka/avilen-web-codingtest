<?php
$T = 0  ;
$A = [];
$B = [];
$C = [];
$input_array = [];

echo "値を入力したら、改行して:qを入力後Enterで確定\n";
while($input_line = fgets(STDIN)) {
    if ($input_line == ":q\n"){
        break;
    }
    array_push($input_array, $input_line);
}
//入力した値をそれぞれの変数に格納
$T = $input_array[0];       
// echo " {$T}";
// for($i = 0; $i < $T; $i++){
//     list($A[$i], $B[$i], $C[$i]) = explode(" ", $input_array[$i + 1]);
//     echo "{$A[$i]} {$B[$i]} {$C[$i]}";
    
// }
for($i = 0; $i < $T; $i++){
    list($A, $B, $C) = explode(" ", $input_array[$i + 1]);
    // echo "{$A} {$B} {$C}";
    // proc((int)$A, (int)$B, (int)$C);
    $ans = proc($A, $B, $C);
    echo "{$ans}\n";
}


function proc($a, $b, $c){
    $count = 0;
    $ans_list = [];
    $a = (int) $a;
    $b = (int) $b;
    $c = (int) $c;
    //3重ループを作る
    //Aに対する操作
    $x = $a;
    for($i = 0; $i < 99; $i++){
        if($i > 0 && 2 <= $x){
            $x--;
            // echo "A - 1を実行\n";
        }
        //Bに対する操作
        $y = $b;
        for($j = 0; $j < 99; $j++){
            if($j > 0 && 2 <= $y){
                $y--;
                // echo "B - 1を実行\n";
            }
            //Cに対する操作
            $z = $c;
            for($k = 0; $k < 99; $k++){
                if($k > 0 && 2 <= $z){  
                    $z--;
                    // echo "C - 1を実行\n";
                }
                //正解の条件
                if(!($x < $y && $y < $z) && !($z < $y && $y < $x) && ($x != $y && $y != $z && $z != $x)){
                    $ans = $i + $j + $k;
                    // echo "answer {$ans} i:{$i}, j:{$j}, k{$k}\n";
                    array_push($ans_list, $ans);
                }
                if($z == 1)
                    $k = 99;
            }
            if($y == 1)
                $j = 99;
        }
        if($x == 1)
            $i = 99;
    }

    if(empty($ans_list)){
        return -1;
    }else{
        sort($ans_list);
        return $ans_list[0];
    }
}

// function minAns($ans_list){
//     if(empty($ans_list)){
//         return -1;
//     }else{
//         sort($ans_list);
//         return $ans_list[0];
//     }
// }

?>
