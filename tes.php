<form action="" method="post">
    <input type="number" name="value" placeholder="masukan jumlah baris" required/>
    <input type="submit" name="check" value="Buat"/>
</form>
<?php
if (isset($_POST['value'])) {
    $baris = $_POST['value'];
    echo "Jumlah Baris $baris" . "<br>";
    $c = 1;
    $a = 0;
    $b = 0;
    $j = 0;
    for ($a = 0; $a < $baris; $a++) {
        for ($b = 1; $b <= $baris - $a; $b++) {
            echo "----";
        }
        for ($j = 0; $j <= $a; $j++) {
            if ($j == 0 || $a == 0) {
                $c = 1;
            } else {
                $c = $c * ($a - $j + 1) / $j;
            }
            echo "---" . $c . "---";
        }
        echo "<br>";
    }
}
?>
    