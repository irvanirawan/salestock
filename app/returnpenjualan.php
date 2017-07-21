<?php
include_once ('header.php');
?>
<div class="box-primary box">
    <div class="box-header box text-center"> <h3>Return Penjualan</h3> </div>
    <form method="post" enctype="multipart/form-data">
        <table class="table">
            <tr>
                <td>ID Transaksi</td>
                <td>
                    <input class="form-control" type="text" name="idnya" placeholder="cari id transaksi" required/>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="center">
                    <input class="button-a button-a-background" type="submit" name="cari_tr" value="Cek transaksi"/>
                </td>
            </tr>
        </table>
    </form>
    <?php
    if (isset($_POST['cari_tr'])) {
        $idnya = $_POST['idnya'];
        $qcr = "select detail_penjualan.id_transaksi,barang.id_barang,detail_penjualan.id_detail, barang.nama_barang, detail_penjualan.jumlah from detail_penjualan left join barang on detail_penjualan.id_barang = barang.id_barang where id_transaksi='$idnya'";
        $ex = mysqli_query($kon, $qcr);
        while ($datacari = mysqli_fetch_array($ex)) {
            ?>
            <form method="post" enctype="multipart/form-data">
                <table class="table table-responsive">
                    <tr>
                    <input type="hidden" name="id_detail[]" value="<?php echo $datacari['id_detail']; ?>">
                    <input type="hidden" name="id_barang[]" value="<?php echo $datacari['id_barang']; ?>">
                    <td><input type="text" name="nama_barang[]" value="<?php echo $datacari['nama_barang']; ?>" readonly></td>
                    <td><input type="text" name="jumlah[]" value="<?php echo $datacari['jumlah']; ?>" readonly></td>
                    <td><input type="number" name="jumlah_return[]" max="<?php echo $datacari['jumlah']; ?>" min="0"></td>
                    </tr>
                </table>
                <?php
            }
            ?>
            <input type="submit" name="breturn" >
        </form>
    <?php }
        if (isset($_POST['breturn'])) {
            echo 'udh diklik';
            $idbreturn = $_POST['id_detail'];
            $idbbarang = $_POST['id_barang'];
            $jumlahreturn = $_POST['jumlah_return'];
            $Id_trx = mysqli_insert_id($kon);
            $jadinya = 0;
            $jadinya2 = 0;
            for ($i = 0; $i < count($idbreturn); $i++) {
                $Id_return = $idbreturn[$i];
                $idbrg = $idbbarang[$i];
                $Jml = $jumlahreturn[$i];
                $q = "select stok from barang where id_barang='$idbrg'";               
                $detail = "update barang set stok=stok+'$Jml' where id_barang='$idbrg'";
                $a = mysqli_query($kon, $detail);
                $detail2 = "update detail_penjualan set jumlah=jumlah-'$Jml' where id_detail='$Id_return'";
                $a2 = mysqli_query($kon, $detail2);
            }
        }
    ?>
    <?php include_once ('footer.php'); ?>