<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('content') ?>

<head>

    <!-- DataTables -->
    <link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Required datatable js -->
    <script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

</head>
<div class="col-sm-12">
    <div class="page-content-wrapper ">

        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Data Kas Masuk</h4>
                    </div>
                    <div class="card-body">

                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-outline-primary" data-target="#addModal" data-toggle="modal">Tambah Data</button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datakasmasuk">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Nama Donatur</th>
                                                <th>Keterangan</th>
                                                <th>Kas Masuk</th>
                                                <th>Jenis Kas</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = 0; ?>
                                            <?php $no = 0;
                                            foreach ($kasmasuk as $val) {
                                                $no++; ?>
                                                <tr role="row" class="odd">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $val['tanggal'] ?></td>
                                                    <td><?= $val['nama'] ?></td>
                                                    <td><?= $val['ket'] ?></td>
                                                    <td><?= $val['kas_masuk'] ?></td>
                                                    <?php $total += $val['kas_masuk'] ?>
                                                    <td><?= $val['jenis_kas'] ?></td>
                                                    <td>

                                                        <button type="button" class="btn btn-outline-dark btn-sm btn-edit" data-id_kasm="<?= $val['id_kas_masjid']; ?>" data-tanggal="<?= $val['tanggal']; ?>" data-iddntr="<?= $val['iddonatur']; ?>" data-namadntr="<?= $val['nama']; ?>" data-ket="<?= $val['ket']; ?>" data-kasmsk="<?= $val['kas_masuk']; ?>" data-jenisk="<?= $val['jenis_kas']; ?>">
                                                            <i class=" fa fa-tags"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-danger btn-sm btn-delete" data-id_kasm="<?= $val['id_kas_masjid']; ?>">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tr>
                                            <th colspan="3">Total Kas Masuk</th>
                                            <th colspan="4"><?= $total ?></th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data-->
<form action="/kasmasuk/save" method="post" autocomplete="off">
    <?php if (!empty(session()->getFlashdata('error'))) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4>Periksa data</h4>
            <hr>
            <?= session()->getFlashdata('error') ?>
            <button type="button" id="addModal" class="btn-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php endif; ?>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-10">
                        <input type="hidden" class="form-control" name="id" id="idkas">
                    </div>
                    <div class="col-md-10">
                        <label for="tgl">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tgl" required>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Donatur</label>
                                    <button type="button" data-toggle="modal" data-target="#modal_donatur" class="btn btn-xs btn-primary">Donatur</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" name="iddonatur" readonly id="iddonatur" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nama Donatur</label>
                                    <input type="text" readonly id="nama" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <label for="ket">Keterangan</label>
                        <input type="text" class="form-control" name="ket" id="ket" required>
                    </div>
                    <div class="col-md-10">
                        <label for="kasmasuk">Kas Masuk</label>
                        <input type="text" class="form-control" name="kasmasuk" id="kasmasuk" required>
                    </div>
                    <div class="col-md-10">
                        <label for="jenis"> Jenis Kas </label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="">Pilih Jenis Kas</option>
                            <option value="anak yatim">Anak Yatim</option>
                            <option value="tpq">TPQ</option>
                            <option value="sosial">Sosial</option>
                            <option value="masjid">Masjid</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end modal tambah data -->

<!-- Modal edit Data-->
<form action="/kasmasuk/edit" method="post" autocomplete="off">
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-10">
                        <input type="hidden" class="form-control idkas" name="id" id="idkas">
                    </div>
                    <div class="col-md-10">
                        <label for="tgl">Tanggal</label>
                        <input type="text" class="form-control tgl" name="tanggal" id="tgl" required>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Donatur</label>
                                    <button type="button" data-toggle="modal" data-target="#modal_donatur" class="btn btn-xs btn-primary">Donatur</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" name="iddonatur" readonly id="iddonatur" class="form-control iddntr">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nama Donatur</label>
                                    <input type="text" readonly id="nama" class="form-control nama">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <label for="ket">ket</label>
                        <input type="ket" class="form-control ket" name="ket" id="ket" required>
                    </div>
                    <div class="col-md-10">
                        <label for="kasmasuk">Kas Masuk</label>
                        <input type="text" class="form-control kasmasuk" name="kasmasuk" id="kasmasuk" required>
                    </div>
                    <div class="col-md-10">
                        <label for="jenis"> Jenis Kas </label>
                        <select name="jenis" id="jenis" class="form-control jenis">
                            <option value="">Pilih Jenis Kas</option>
                            <option value="anak yatim">Anak Yatim</option>
                            <option value="tpq">TPQ</option>
                            <option value="sosial">Sosial</option>
                            <option value="masjid">Masjid</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end modal edit data -->

<!-- Modal Delete-->
<form action="/kasmasuk/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3 style="color: red;">Apakah Anda Yakin Menghapus Data Ini ?</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idk" class="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end modal delete -->

<!-- Modal Donatur -->
<form action="">
    <div class="modal fade" id="modal_donatur">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Donatur</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama Donatur</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($data_donatur as $d) :
                                $no++; ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?= $d->iddonatur ?></td>
                                    <td><?= $d->nama ?></td>
                                    <td><?= $d->nohp ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="return pilih_donatur('<?= $d->iddonatur ?>','<?= $d->nama ?>')">
                                            Pilih
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- End Modal donatur -->


<script>
    // script edit
    $('.btn-edit').on('click', function() {
        const id = $(this).data('id_kasm');
        const tgl = $(this).data('tanggal');
        const idd = $(this).data('iddntr');
        const name = $(this).data('namadntr');
        const ket = $(this).data('ket');
        const km = $(this).data('kasmsk');
        const jns = $(this).data('jenisk');

        $('.idkas').val(id);
        $('.tgl').val(tgl);
        $('.iddntr').val(idd);
        $('.nama').val(name);
        $('.ket').val(ket);
        $('.kasmasuk').val(km);
        $('.jenis').val(jns).trigger('change');

        $('#editModal').modal('show');
    });

    // script delete
    $('.btn-delete').on('click', function() {
        const id = $(this).data('id_kasm');
        $('.id').val(id);
        $('#deleteModal').modal('show');
    });

    // script datatable
    $(document).ready(function() {
        $('#datakasmasuk').DataTable();
    });

    // Script Donatur
    function pilih_donatur(id, nama) {
        $('#iddonatur').val(id);
        $('#nama').val(nama);
        $('#modal_donatur').modal().hide();
        // $('#modal_obat .close').click()
    }
</script>
<?php $this->endSection('') ?>