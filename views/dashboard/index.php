<?php
if ($isSales) {
    \app\assets\HighchartAsset::register($this);
}
?>
<div class="page-wrapper" data-menu-active="Beranda">
    <div class="container-xl">
        
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item active"><a href="index.php">Beranda</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Beranda</h2>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="alert mb-2">
                <h3>
                    Halo, selamat datang <strong><?= Yii::$app->user->identity->nama; ?></strong> di aplikasi pemasaran dan selamat bekerja.
                </h3>
                <p><i>
                    "Fokuskan tujuan yang ingin didapat, jangan biarkan faktor lain menghalangi tujuan Anda."
                </i></p>
            </div>

            <?php if ($isSales) { ?>
                <div class="row g-2">
                <div class="col-lg-6">
                    <div class="card d-flex h-100">
                        <div class="card-header fw-bold py-2">
                            Capaian Anda hari ini
                        </div>
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-8">
                                    <div id="capaian"></div>
                                </div>
                                <div class="col-4">
                                    <?php
                                    if (is_null($currentAchievement)) {
                                        $currentSale = 0;
                                    } else {
                                        $currentSale = $currentAchievement->total_sale;
                                    }
                                    ?>
                                    <table class="table table-striped mt-3 table-sm">
                                        <tr>
                                            <td width="5"></td>
                                            <td>Target bulan ini</td>
                                            <td class="text-end"><b><?= $salesOrders->toShort($currentPlan->saleTarget); ?></b></td>
                                        </tr>
                                        <tr>
                                            <td width="5"></td>
                                            <td>Capaian bulan ini</td>
                                            <td class="text-end"><b><?= $salesOrders->toShort($currentSale); ?></b></td>
                                        </tr>
                                        <tr>
                                            <td width="5"><i class="bi bi-circle-fill" style="color:#dddddd;"></i></td>
                                            <td>Target tahun ini</td>
                                            <td class="text-end"><b><?= $salesOrders->toShort($currentPlan->target_penjualan); ?></b></td>
                                        </tr>
                                        <tr>
                                            <td width="5"><i class="bi bi-circle-fill" style="color:#73F973;"></i></td>
                                            <td>Capaian tahun ini</td>
                                            <td class="text-end"><b><?= $salesOrders->toShort($achievement); ?></b></td>
                                        </tr>
                                    </table>
                                </div>
                                <?php
                                $dailyPercentage = round(($currentSale / $currentPlan->saleTarget) * 100, 2);
                                $yearlyPercentage = round(($achievement / $currentPlan->target_penjualan) * 100, 2);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header fw-bold py-3">
                            List Sales Order Terbaru
                        </div>
                        <div class="card-body p-0">
                            <table class="table m-0 table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th class="ps-3">Prospek</th>
                                        <th class="ps-3">SO</th>
                                        <th class="ps-3 text-end">Nilai</th>
                                        <th class="ps-3 text-center">Disetujui</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($lastOrders)) {
                                    ?>
                                        <tr><td class="text-center" colspan="4">Tidak ada data</td></tr>
                                    <?php
                                    } else {
                                        foreach ($lastOrders as $key => $val) {
                                            $background = ($key != 1) ? ' style="background: #dfd"': '';
                                            $isVerified = $salesOrders::IS_VERIFIED == $val['is_verified'];

                                            if ($isVerified) {
                                                $status = '<td class="text-center" style="font-size:24px; vertical-align: middle;">
                                                    <i class="bi bi-check2-circle text-success"></i>
                                                </td>';
                                            } else {
                                                $status = '<td class="text-center"></td>';
                                            }
                                    ?>
                                            <tr<?= $background; ?>>
                                                <td class="ps-3">
                                                    <?= $val['kebutuhan']; ?> <br />
                                                    <span style="font-size: 12px;color: #844;"><?= $val['nama_perusahaan']; ?></span>
                                                </td>
                                                <td>
                                                    <?= $val['kode']; ?><br />
                                                    <span style="font-size: 12px;color: #844;"><?= date('d/m/Y', strtotime($val['tanggal'])); ?></span>
                                                </td>
                                                <td class="text-end">Rp <?= $salesOrders->toRupiah($val['nilai']); ?></td>
                                                <?= $status; ?>
                                            </tr>
                                        <?php
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
               
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header fw-bold py-3">
                            List prospek menunggu untuk ditindak lanjuti
                        </div>
                        <div class="card-body p-0">
                            <table class="table m-0 table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th class="ps-3">Prospek</th>
                                        <th class="ps-3">Aktifitas Terakhir</th>
                                        <th class="ps-3">Time Passed</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($lastLeads) {
                                        foreach ($lastLeads as $key => $val) {
                                            $style = '';

                                            if ($key == 0) {
                                                $style = ' style="background:#fdd"';
                                            }

                                            $activities = $val->getLastActivities($val->id);
                                            $activity = [];

                                            if (empty($activities)) {
                                                $activity['aktivitas'] = 'Lead dibuat';
                                                $activity['tanggal'] = $val->timestamp;
                                                $dateDiff = 0;
                                            } else {
                                                $activity = $activities;
                                                $lastDate = new DateTimeImmutable($activities['tanggal']);
                                                $currentDate = new DateTimeImmutable(date('Y-m-d'));
                                                $interval = $lastDate->diff($currentDate);
                                                $dateDiff = $interval->format('%a');
                                            }

                                            echo "<tr{$style}>";
                                            echo "  <td class=\"ps-3\">";
                                            echo $val->kebutuhan . "<br />";
                                            echo $val->nama_perusahaan;
                                            echo "  </td>";
                                            echo "  <td>";
                                            echo $activity['aktivitas'] . " <br />";
                                            echo date('d/m/Y', strtotime($activity['tanggal']));
                                            echo "  </td>";
                                            echo "  <td class=\"text-center\">{$dateDiff} hari</td>";
                                            echo "</tr>";
                                        }

                                    } else {
                                        echo '<tr><td colspan="3">Tidak ada data</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header fw-bold py-3">
                            List quotation menunggu untuk ditindak lanjuti
                        </div>
                        <div class="card-body p-0">
                            <table class="table m-0 table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th class="ps-3">Prospek</th>
                                        <th class="ps-3">Quotation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($lastQuotations)) {
                                        echo '<tr><td class="ps-3" colspan="2"></td></tr>';
                                    } else {
                                        foreach ($lastQuotations as $key => $val) {
                                            $style = '';

                                            if ($key == 0) {
                                                $style = ' style="background:#fdd"';
                                            }

                                            echo "<tr{$style}>";
                                            echo "  <td clas=\"ps-3\">";
                                            echo $val['kebutuhan'] . "<br />";
                                            echo $val['nama_perusahaan'];
                                            echo "  </td>";
                                            echo "  <td>";
                                            echo $val['kode'] . ' - ' . $salesOrders->toRupiah($val['nilai'], true) . ' <br />';
                                            echo "  </td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php } ?>
        </div>
    </div>
</div>
<?php
if ($isSales) {
    $css = "
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    ";

    $js = "
    Highcharts.chart('capaian', {
        colors: ['#73F973','#dddddd'],
        chart: {
            type: 'bar',
            height:'200px'
        },
        title: {
            text: 'Capaian Penjualan',
            align: 'center'
        },
        xAxis: {
            categories: ['Tahun Ini'],
            title: {
                text: null
            },
            gridLineWidth: 1,
            lineWidth: 0
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Presentase (%)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            },
            gridLineWidth: 0
        },
        tooltip: {
            valueSuffix: ' persen'
        },
        plotOptions: {
            bar: {
                borderRadius: '10%',
                dataLabels: {
                    enabled: true
                },
                groupPadding: 0.1
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'capaian',
            data: [{$yearlyPercentage}]
        }, {
            name: 'target',
            data: [100]
        }]
    });";

    $this->registerCss($css);
    $this->registerJs(
        $js,
        $this::POS_END,
        'highchart-handler'
    );
}
