<?php
$n = 0; //水溶液の数:1 <= n <= 100
$N = 0; //目標の濃度:1 <= N <= 100
$A = []; //使用する水溶液の濃度のリスト
$A_max = 0; //$Aの水溶液の濃度の中で最大のもの
$A_min = 0; //$Aの水溶液の濃度の中で最小のもの
$input_array = [];

echo "値を入力したら、改行して:qを入力後Enterで確定\n";
while($input_line = fgets(STDIN)) {
    if ($input_line == ":q\n"){
        break;
    }
    array_push($input_array, $input_line);
}
//入力した値をそれぞれの変数に格納
list($n, $N) = explode(" ", $input_array[0]);       
// echo " {$n}";
// echo " {$N}";
$A = explode(" ", $input_array[1]);
// for($i = 0; $i < $n; $i++){
//     echo " {$A[$i]}";
// }

//入力した水溶液の濃度の最小値と最大値を求める
$A_min = $A[0];
$A_max = $A[$n - 1];
//目標の濃度が、入力した水溶液の濃度の最大値と最小値の間ならYes
if($A_min <= $N && $N <= $A_max){
    echo "Yes\n";
}else {
    echo "No\n";
}

?>