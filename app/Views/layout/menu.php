<?= $this->extend('layout/main') ?>
<?= $this->section('menu') ?>

<li>
    <a href="<?= site_url('layout') ?>" class="waves-effect">
        <i class="mdi mdi-airplay"></i>
        <span> Beranda <span class="badge badge-pill badge-primary float-right">7</span></span>
    </a>
</li>
<?php if (session()->get('level') == 1) { ?>
    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-layers"></i><span> Master </span><span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
        <ul class="list-unstyled">
            <li><a href="<?= site_url('Admin') ?>">Admin</a></li>
            <li><a href="<?= site_url('user') ?>">User</a></li>
            <li><a href="<?= site_url('pengurus') ?>">Pengurus</a></li>
            <li><a href="<?= site_url('agenda') ?>">Kegiatan</a></li>
            <li><a href="<?= site_url('kasmasuk') ?>">Kas Masuk</a></li>
        </ul>
    </li>
<?php } ?>
<?php if (session()->get('level') == 1 || session()->get('level') == 2) { ?>
    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cards-outline"></i> <span> Transaksi </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
        <ul class="list-unstyled">
            <li><a href="<?= site_url('kasmasuk') ?>">Kas Masuk</a></li>
            <li><a href="<?= site_url('') ?>">Uang Keluar</a></li>
            <li><a href="<?= site_url('agenda') ?>">Kegiatan</a></li>
        </ul>
    </li>
<?php } ?>
<?php if (session()->get('level') == 1 || session()->get('level') == 3) { ?>
    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cards-outline"></i> <span> Pendanaan </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
        <ul class="list-unstyled">
            <li><a href="">Infak Masjid</a></li>
            <li><a href="<?= site_url('') ?>">Infak Anak Yatim</a></li>
            <li><a href="<?= site_url('') ?>">Infak Duafa</a></li>
            <li><a href="<?= site_url('') ?>">Upload Bukti</a></li>
        </ul>
    </li>
<?php } ?>
<?php if (session()->get('level') == 1 || session()->get('level') == 4) { ?>
    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect"><i class=" mdi mdi-cards-outline"></i> <span> Laporan </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
        <ul class="list-unstyled">
            <li><a href="<?= site_url('') ?>">Laporan Uang Masuk</a></li>
            <li><a href="<?= site_url('') ?>">Laporan Uang Keluar</a></li>
            <li><a href="<?= site_url('') ?>">Laporan Kegiatan</a></li>
        </ul>
    </li>
<?php } ?>
<?= $this->endsection('') ?>