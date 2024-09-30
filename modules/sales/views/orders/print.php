<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SALES ORDER</title>
    <style>
        *,*:before,*:after{
            margin: 0;
            padding:0;
            box-sizing: border-box;
        }
        body{
            font-family: sans-serif;
        }
        table.table{
            border:1px solid #000;
            border-collapse: collapse;
        }
        table.table th,
        table.table td{
            padding:5px;
        }
        table.table th{
            background: #000;
            color:#fff;
        }
    </style>
</head>
<body>
    <div style="margin:30px">
        <div class="header">
            <table width="100%">
                <tr>
                    <td width="100">
                        <img src="/image/logo_jmc_black.png" alt="" width="100" />
                    </td>
                    <td style="padding-left: 30px;">
                        <h3>JMC INDONESIA</h3>
                        <br/>
                        <p>
                            Jl. Prapanca No.6a, Bantul, D.I.Yogyakarta<br/>
                            Phone :  (0274) 588 599 Email : halo@jmc.co.id
                        </p>
                    </td>
                </tr>
            </table>
        </div>
        <hr style="margin-top:30px;border:none;border-bottom: 4px solid #000;" />
        <hr style="margin-top:2px;margin-bottom:30px;border:none;border-bottom: 1px solid #000;" />
        <table width="100%">
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td></td>
                            <td width="300" align="right">
                                <h2>SALES ORDER</h2>
                                <br/>
                                <table width="100%">
                                    <tr>
                                        <td width="150">Nomor SO</td>
                                        <td align="right"><?= $model->kode; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal SO</td>
                                        <td align="right"><?= date('d/m/Y', strtotime($model->timestamp)); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td align="right"><?= $model->status; ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" cellspacing="30">
                        <tr>
                            <td width="50%" valign="top"></td>
                            <td width="50%" valign="top" style="line-height: 24px;">
                                <h4>Order Dari</h4>
                                <hr style="margin:15px 0;" />
                                <?= $model->nama_klien; ?><br />
                                <b><?= $model->nama_perusahaan; ?></b><br />
                                Telp. <?= $model->nomor_telepon; ?><br/>
                                Email. <?= $model->email; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" class="table" border="1" style="border-collapse: collapse;border:1px solid #000;">
                        <thead>
                            <tr>
                                <th class="bg-dark">Produk</th>
                                <th class="bg-dark">Kuantitas</th>
                                <th class="bg-dark" align="right">Harga</th>
                                <th class="bg-dark" align="right">Diskon</th>
                                <th class="bg-dark" align="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $subTotal = 0;
                            $totalDiscount = 0;
                            foreach ($model->salesOrderDetails as $val) {
                                $subTotal += ($val->price * $val->jumlah);
                                $totalDiscount += $val->discount;
                            ?>
                            <tr>
                                <td>
                                    <div><b><?= $val->kode_produk . ' - ' . $val->nama_produk; ?></b></div>
                                    <div class="text-secondary"><?= $val->nama_kategori; ?></div>
                                </td>
                                <td align="right"><?= $val->jumlah; ?></td>
                                <td align="right"><?= $val->toRupiah($val->price); ?></td>
                                <td align="right"><?= $val->toRupiah($val->discount); ?></td>
                                <td align="right"><?= $val->toRupiah(($val->price * $val->jumlah - $val->discount)); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <br/>
                    <table border="0" width="400" style="line-height:24px">
                        <tr>
                            <td><strong>Subtotal</strong></td>
                            <td style="text-align:right">
                                <span id="summary-subtotal"><?= $model->toRupiah($subTotal); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Pajak</strong></td>
                            <td style="text-align:right">
                                <span id="summary-subtotal"><?= $model->toRupiah($model->tax); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Diskon</strong></td>
                            <td style="text-align:right">
                                <span id="summary-subtotal"><?= $model->toRupiah($totalDiscount); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Jumlah Total</strong></td>
                            <?php $total = $subTotal + $model->tax - $totalDiscount; ?>
                            <td style="text-align:right">
                                <strong>Rp. <span id="summary-subtotal"><?= $model->toRupiah($total); ?></span></strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
