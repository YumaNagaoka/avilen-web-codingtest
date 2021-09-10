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
// echo $T, "\n";       
for($i = 0; $i < $T; $i++){
    list($A, $B, $C) = explode(" ", $input_array[$i + 1]);
    $ans = proc($A, $B, $C);
    echo "{$ans}\n";
}

//
function proc($a, $b, $c){
    // echo "procを実行";
    $count_A = 0;
    $count_B = 0;
    $count_C = 0;
    $ans_list = [];
    $a = (int) $a;
    $b = (int) $b;
    $c = (int) $c;
    $flg = false;
    $flg_escapeA = false;
    $flg_escapeB = false;
    $flg_escapeC = false;
    //Cが一番大きいとき
    if($c > $a && $c > $b){
        // echo "Cが一番大きいとき";
        if($a != 1){    //aが1以外のとき
            $flg_escapeC = true;
        }else {     //aが1のとき
            if($b > $a){
                $count_C = $c - $b;
                $c = $b;
            }elseif($a == $b){
                return 1;
            }else {
                $count_C = $c - $a;
                $c = $a;
            }
        }
    }elseif($a > $c && $a > $b){ //Aが一番大きいとき
        // echo "Aが一番大きいとき";
        $flg_escapeA = true;
        if($b > $c){
            $flg_escapeC = true;
        }elseif($c == $b){
            return 1;
        }
    }elseif($b > $c && $b > $a) {//Bが一番大きいとき
        // echo "Bが一番大きいとき";
        if($a == $c){
            return 1;
        }
        $flg_escapeB = true;
    }elseif($a == $c && $a > $b){
        // echo "AとCが同じでBより大きいとき";
        if($a - 1 == $b){//BがAとCより1だけ小さいとき
            return 2;
        }
        return 1;
    }elseif($a == $b && $a == $c){
        // echo "ABCが同じ数のとき";
        return 3;
    }

    $count_a = $count_A;
    $count_b = $count_B;
    $count_c = $count_C;
    //3重ループを作る
    //Aに対する操作
    for($x = $a; $x >= 1; $x--, $count_a++){
        //Bに対する操作
        for($y = $b; $y >= 1; $y--, $count_b++){
            //Cに対する操作
            for($z = $c; $z >= 1; $z--, $count_c++){
                // echo $count_a, $count_b, $count_c, "\n";
                //正解の条件
                if(!($x < $y && $y < $z) && !($z < $y && $y < $x) && ($x != $y && $y != $z && $z != $x)){
                    
                    $entire_count = $count_a + $count_b + $count_c;
                    // echo "answer {$entire_count} A:{$x}, B:{$y}, C{$z}\n";
                    if($entire_count == 0){
                        return 0;
                    }
                    array_push($ans_list, $entire_count);
                    $flg = true;
                    break;
                }
                if ($flg_escapeC){
                    break;
                }
            }
            $count_c = $count_C;
            if ($flg || $flg_escapeB){
                break;
            }
        }
        $count_b = $count_B;
        if($flg || $flg_escapeA)
            break;
    }
    //最小の操作回数をreturn。また、条件を満たせなければ-1をreturn
    if(empty($ans_list)){
        return -1;
    }else{
        sort($ans_list);
        $ans = $ans_list[0];
        unset($ans_list);
        return $ans;
    }
}

?>
