<?php 
//for ($index = 0; $index < 5; $index++) {
//    for ($index1 = 0; $index1 < 5-$index; $index1++) {
//     echo '*';   
//    }echo '<br>';
//}
$a=0;
$coef=0;
$baris=5;
for ($a = 0; $a < $baris; $a++) {
    echo $a." baris ".$a."<br>";
}
$cobacoba=2*(2-2+1)/2;
echo $cobacoba;

$baris=5;
$a=0;
$b=0;
$c=1;
for ($a = 0; $a < $baris; $a++) {
    for ($j = 0; $j < $a; $j++) {
        if ($a==0 || $j==0) {
            $c=1;
        } else {
            $c=$c*($a-$j+1)/$j;
        }echo '----'.$c.'-';
    }echo '<br>';
}



?>