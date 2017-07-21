<?php include ('header.php'); ?>
<script src="../plugins/highchart/code/highcharts.js"></script>
<script src="../plugins/highchart/code/modules/exporting.js"></script>
<div class="box">
    <div class="box-body">
        <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div><br>
            </div>
</div>
        <div class="box">
    <div class="box-body">
<div id="container2" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
    </div>
</div>

<script type="text/javascript">

    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Stok Barang 5 Terbawah'
        },
        subtitle: {
            text: 'Periode'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '<b>{point.y:.0f} Pcs</b>'
        },
        series: [{
                name: 'Population',
                data: [
<?php
$query_grafik = "SELECT * FROM barang ORDER BY stok LIMIT 5";
$exe_qg = mysqli_query($kon, $query_grafik);
while ($isigrafik = mysqli_fetch_array($exe_qg)) { ?>
                        ['<?php echo $isigrafik['nama_barang']; ?>', <?php echo $isigrafik['stok']; ?>],

<?php } ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
    });
    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: '5 Barang Terlaris'
        },
        subtitle: {
            text: 'Periode'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '<b>{point.y:.0f} Pcs</b>'
        },
        series: [{
                name: 'Population',
                data: [
['tes',10],['wa',20]
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
    });
</script>
<?php include ('footer.php'); ?>