<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('content') ?>

<div class="col-sm-12">
    <div class="card card-outline ">
        <div class="invoice col-sm-12 p-3 mb-3">
            <!-- title row -->
            <div id="div1">
                <div class="row">
                    <div class="col-sm-12">
                        <table>
                            <tr>
                                <td width=200>

                                </td>
                                <td width=580>
                                    <center>
                                        <p>
                                        <h4>Masjid Istiqlal</h4>
                                        </p>
                                        <p>
                                        <h5>Jln.M.yamin, Payakumbuh</h5>
                                        </p>
                                    </center>
                                </td>
                                <td width=200></td>
                            </tr>
                        </table>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr role="row">
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Donatur</th>
                                    <th>Keterangan</th>
                                    <th>Kas Masuk</th>
                                    <th>Jenis Kas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                $semua = 0;
                                foreach ($kasmasuk as $val) {
                                    $s = $val['kas_masuk'];
                                    $semua = $s + $semua;
                                    $no++; ?>
                                    <tr role="row" class="odd">
                                        <td><?= $no; ?></td>
                                        <td><?= $val['tanggal'] ?></td>
                                        <td><?= $val['nama'] ?></td>
                                        <td><?= $val['ket'] ?></td>
                                        <td><?= $val['kas_masuk'] ?></td>
                                        <td><?= $val['jenis_kas'] ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <th colspan="3">Total Kas Masuk</th>
                                    <th colspan="4"><?= $semua ?></th>
                                </tr>
                            </tbody>
                        </table>
                        <br><br><br><br>
                        Payakumbuh, <?= date('d/M/y') ?>
                        <br><br><br>
                        Ketua <br>
                        Habil Yakub Arafah
                    </div>
                </div>
            </div>
            <div class="row no-print">
                <div class="col-12">
                    <button onclick="printContent('div1')" class="btn btn-primary"><i class="fa fa-print">Print Data</i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // script print
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
<?php $this->endSection('') ?>