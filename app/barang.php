<?php
include_once ('header.php');
//untuk hapus
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "DELETE FROM barang WHERE id_barang='$id' ";
    $hasil_query = mysqli_query($kon, $query);
    if (!$hasil_query) {
        die("Gagal menghapus data: " . mysqli_errno($link) .
                " - " . mysqli_error($link));
    }
}
    if (isset($_GET['delete_id'])) {
        $sql_query = "DELETE FROM barang WHERE id_barang=" . $_GET['delete_id'];
        $exe= mysqli_query($kon, $sql_query);
        
    }
    ?>

<div class="box">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Barang</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>No.</th>
                            <th>Nama Barang</th>
                            <th>Kode Barang</th>
                            <th>Harga_Beli</th>
                            <th>Harga Jual</th>
                            <th>Kategori</th>
                            <th>marek</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                        <?php
                        $no = 1;
                        $sq = "select barang.id_barang,barang.nama_barang,barang.kode_barang, barang.harga_beli, barang.harga_jual, barang.stok, barang.status, merek.nama_merek, kategori.nama_kategori from barang left join merek on merek.id_merek = barang.id_merek left join kategori on kategori.id_kategori=barang.id_kategori";
                        $qbrg = mysqli_query($kon, $sq);
                        while ($row = mysqli_fetch_array($qbrg)) {
                            ?>
                            <tr>
                                <td><?php
                                    echo $no++;
                                    $row['id_barang']
                                    ?></td>
                                <td><?php echo $row['nama_barang']; ?></td>
                                <td><?php echo $row['kode_barang']; ?></td>
                                <td><?php echo $row['harga_beli']; ?></td>
                                <td><?php echo $row['harga_jual']; ?></td>
                                <td><?php echo $row['nama_kategori']; ?></td>
                                <td><?php echo $row['nama_merek']; ?></td>
                                <td><?php echo $row['stok']; ?></td>
                                <td style="text-align: center"><?php
                                    $s = $row['status'];
                                    if ($s == 1) {
                                        echo "<small class='label pull-left bg-blue'>Aktiv</small>";
                                    } else {
                                        echo "<small class='label pull-left bg-red'>Tidak Aktiv</small>";
                                    }
                                    ?></td>
                            <script type="text/javascript">
                                function delete_id(id)
                                {
                                    if (confirm('Hapus ?'))
                                    {
                                        window.location.href = 'barang.php?delete_id=' + id;

                                    }
                                }
                            </script>
                            <td>
                                <a href="edit_barang.php?id=<?php echo $row['id_barang'] ?>">Edit</a> /
                                <a href="javascript:delete_id(<?php echo $row['id_barang']; ?>)">Delete</a>

                            </td>
                            </tr>
                        <?php }
                        ?>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
<!--<div class="nav-tabs-custom">
     Tabs within a box 
    <ul class="nav nav-tabs pull-right">
        <li class="active">Area</li>
        <li>Donut</li>
        <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
    </ul>
    <div class="tab-content no-padding">
         Morris chart - Sales 
        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
    </div>
</div>-->
<?php
include_once ('footer.php');
?>