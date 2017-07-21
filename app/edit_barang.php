<?php
include_once ('./../header.php');
$qeditb = "SELECT
  barang.id_barang,
  barang.nama_barang,
  barang.kode_barang,
  barang.harga_beli,
  barang.harga_jual,
  barang.stok,
  barang.status,
  merek.id_merek,
  merek.nama_merek,
  kategori.id_kategori,
  kategori.nama_kategori
FROM
  barang
  left JOIN kategori ON kategori.id_kategori = barang.id_kategori
  left JOIN merek ON merek.id_merek = barang.id_merek
 where id_barang=" . $_GET['id'] . "";
$data = mysqli_fetch_array(mysqli_query($kon, $qeditb));
if (isset($_POST['zz'])) {
    $a = $_POST['a']; //nb
    $b = $_POST['b']; //kb
    $c = $_POST['c']; //kat
    $d = $_POST['d']; //mer
    $e = $_POST['e']; //hj
    $f = $_POST['f']; //beli
    $g = $_POST['g']; //stok
    $h = $_POST['h']; //stts
    $id_edit_barang = $_POST['id'];
    $query_update_barang = "UPDATE barang SET kode_barang = '$b', nama_barang = '$a', harga_jual = '$e', stok = '$g', id_kategori = '$c', id_merek = '$d', status = '$h', harga_beli = '$f' WHERE barang.id_barang ='$id_edit_barang'";
    $eksekusi_update_barang = mysqli_query($kon, $query_update_barang);
    if ($eksekusi_update_barang) {
        echo "<div class='callout callout-success'>
                <h4>Data Telah Diperbarui</h4>
                <p><a href='barang.php'>Lihat Data Barang</a></p>
              </div>";
    } else {
        echo 'belum tersimpan';
        mysqli_error_list($kon);
    }
}
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Data Barang</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->   
    <form class="form-horizontal" method="post">
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Barang</label>
                <div class="col-sm-10">
                    <input type="hidden" name="id" value="<?php echo $data['id_barang']; ?>">
                    <input name="a" type="text" class="form-control" value="<?php echo $data['nama_barang']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Kode Barang</label>
                <div class="col-sm-10">
                    <input name="b" type="text" class="form-control" value="<?php echo $data['kode_barang']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Kategori</label>
                <div class="col-sm-10">
                    <select name="c" class="form-control">
                        <?php
                        $query_kategori = mysqli_query($kon, "select * from kategori");
                        while ($data_kategori = mysqli_fetch_array($query_kategori)) {
                            ?>
                            <option value="<?php echo $data_kategori['id_kategori']; ?>" <?php
                            if ($data_kategori['id_kategori'] == $data['id_kategori']) {
                                echo 'selected';
                            }
                            ?>><?php echo $data_kategori['nama_kategori']; ?></option>
<?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Merek</label>
                <div class="col-sm-10">
                    <select name="d" class="form-control">
                        <?php
                        $query_merek = mysqli_query($kon, "select * from merek");
                        while ($data_merek = mysqli_fetch_array($query_merek)) {
                            ?>
                            <option value="<?php echo $data_merek['id_merek']; ?>" <?php
                            if ($data_kategori['id_merek'] == $data['id_merek']) {
                                echo 'selected';
                            }
                            ?>><?php echo $data_merek['nama_merek']; ?></option>
<?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Harga Jual</label>
                <div class="col-sm-10">
                    <input name="e" type="number" class="form-control" value="<?php echo $data['harga_jual']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Harga Beli</label>
                <div class="col-sm-10">
                    <input name="f" type="number" class="form-control" value="<?php echo $data['harga_beli']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Stok</label>
                <div class="col-sm-10">
                    <input name="g" type="number" class="form-control" value="<?php echo $data['stok']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                    <label><?php if ($data['status'] == 1) { ?>
                            <select name="h" class="form-control">
                                <option value="1" selected>Aktiv</option>
                                <option value="0">Tidak Aktiv</option>
                            </select>
<?php } else {
    ?>
                            <select name="h" class="form-control">
                                <option value="1" >Aktiv</option>
                                <option value="0" selected>Tidak Aktiv</option>
                            </select>
<?php } ?>                            
                    </label>
                </div>
            </div>            
            <div class="box-footer">
                <input type="submit" name="zz" value="Simpan">
            </div>
        </div>
    </form>
</div>
<?php
include_once ('./../footer.php');
?>