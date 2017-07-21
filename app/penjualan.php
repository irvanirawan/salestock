<?php
include_once ('header.php');
?>
<?php
if (isset($_POST['Save'])) {
    $header = "insert into penjualan(tanggal,customer) values('" . $_POST['tanggal'] . "','" . $_POST['customer'] . "')";
    $header_proses = mysqli_query($kon, $header);
    if ($header_proses) {
        $data_id_komponen = $_POST['id'];
        $jmls = $_POST['jumlah'];

        $Id_trx = mysqli_insert_id($kon);
        $total = 0;
        for ($i = 0; $i < count($data_id_komponen); $i++) {
            $Id_komponen = $data_id_komponen[$i];
            $Jml = $jmls[$i];
            $q = "select harga_barang from barang where id_barang='$Id_komponen'";
            if ($hasil = mysqli_fetch_array(mysqli_query($kon, $q))) {
                $harga_barang = $hasil[0];
                $total=$Jml*$harga_barang;
            }
            $detail = "insert into detail_penjualan(id_transaksi,id_barang,jumlah,total_harga)
		values('$Id_trx','$Id_komponen','$Jml','$total')";
            $a = mysqli_query($kon, $detail);
            $b= mysqli_query($kon, "update barang set stok=stok-'$Jml' where id_barang='$Id_komponen'");
        }
    }
}
?>
<div class="box-primary box">
    <div class="box-header box text-center"> <h3>Penjualan</h3> </div>
<form method="post" enctype="multipart/form-data">
    <table class="table">
        <tr>
            <td>Tanggal</td>
            <td>
                <input type="text" name="tanggal" value="<?php $t = date('Y-m-d');
echo $t;
?>"/>
            </td>
        </tr>
        <tr>
            <td>Customer</td>
            <td><input name="customer" type="text" value="tidak dipilih"></td>
        </tr>
    </table>

    <?php
    $q = 'select * from barang';
    $w = mysqli_query($kon, $q);
    while ($h = mysqli_fetch_array($w)) {
        $account[] = array("id_barang" => $h['id_barang'], "nama_barang" => $h['nama_barang'], "harga_jual" => $h['harga_jual']);
    }
    ?>

    <table class="table table-striped table table-bordered">
        <tr id="baris">
            <td>Barang</td>
            <td>Jumlah</td>
        </tr>
        <tr>
            <td>
                <select name="id[]" id="textfield2" class="form-control" />
                <?php
                $q = 'select * from barang';
                $w = mysqli_query($kon, $q);
                while ($d = mysqli_fetch_array($w)) {
                    ?>
            <option value="<?php echo $d['id_barang']; ?>"><?php echo $d['nama_barang']; ?></option><?php } ?>
        </select> 
        </td>
        <td><input type="text" name="jumlah[]" id="textfield2" class="form-control" /></td>
        </tr>
        <tr id="tambah">
            <td colspan="">
             <span><input type="button" class="btn-large btn-success" id="tambah" name="baris" value="tambah barang"/></span>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <input type="submit" class="btn btn-small btn-danger" name="Save" value="simpan"/>
            </td>
        </tr>
    </table>
</form>
</div>
<script src="jquery.js"></script>

<script>
    $(document).ready(function (e) {
        var data = '<tr>'
                + '<td>'
                + '<select name="id[]" id="acount" class="form-control">'
<?php foreach ($account as $b) { ?>
            + '<option value="<?php echo $b['id_barang']; ?>"><?php echo $b['nama_barang']; ?></option>'
<?php } ?>
        + '</select></td>'
                + '<td>'
                + '<input type="text" name="jumlah[]" value="" id="textfield2" class="form-control" /></td>'
                + '<td>'
                + '</tr>';
        $("#tambah").click(function () {
            //  alert('ok');
            $("#tambah").before(data);

        });
    });


</script>
<?php
 include_once ('footer.php'); ?>