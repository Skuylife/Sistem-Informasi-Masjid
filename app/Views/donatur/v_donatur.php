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

    <!-- Jquery edit-->
    <script src="assets/plugins/tiny-editable/mindmup-editabletable.js"></script>
    <script src="assets/plugins/tiny-editable/numeric-input-example.js"></script>
    <script src="assets/plugins/tabledit/jquery.tabledit.js"></script>

</head>
<div class="col-sm-12">
    <div class="page-content-wrapper ">

        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Data Donatur</h4>
                    </div>
                    <div class="card-body">

                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-outline-primary" data-target="#addModal" data-toggle="modal">Tambah Data</button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datadonatur">
                                        <thead class="thead-default">
                                            <tr role="row">
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Nama Donatur</th>
                                                <th>Alamat</th>
                                                <th>NoHp</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($donatur as $val) {
                                                $no++; ?>
                                                <tr role=" row" class="odd table-primary">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $val['iddonatur'] ?></td>
                                                    <td><?= $val['nama'] ?></td>
                                                    <td><?= $val['alamat'] ?></td>
                                                    <td><?= $val['nohp'] ?></td>
                                                    <td>

                                                        <button type="button" class="btn btn-outline-dark waves-effect waves-light btn-edit" data-id-donatur="<?= $val['iddonatur']; ?>" data-nama-Donatur="<?= $val['nama']; ?>" data-alamat="<?= $val['alamat']; ?>" data-no-hp="<?= $val['nohp']; ?>">
                                                            <i class=" ion-compose"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-danger waves-effect waves-light btn-delete" data-iddonatur="<?= $val['iddonatur']; ?>">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
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
<form action="/Donatur/save" method="post" autocomplete="off">
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
                        <label for="id-dntr">ID Donatur</label>
                        <input type="text" class="form-control " name="id" id="id-dntr" required>
                    </div>
                    <div class="col-md-10">
                        <label for="namadonatur">Nama Donatur</label>
                        <input type="text" class="form-control" name="namadonatur" id="namadonatur" required>
                    </div>
                    <div class="col-md-10">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" required>
                    </div>
                    <div class="col-md-10">
                        <label for="nohp">No HP</label>
                        <input type="text" class="form-control" name="nohp" id="nohp" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end modal tambah data -->

<!-- Modal edit Data-->
<form action="/Donatur/edit" method="post" autocomplete="off">
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-10">
                        <label for="id-dntr">ID Donatur</label>
                        <input type="text" class="form-control id-dntr" name="id-dntr" id="id-dntr" required>
                    </div>
                    <div class="col-md-10">
                        <label for="namadonatur">Nama Donatur</label>
                        <input type="text" class="form-control nama" name="namadonatur" id="namadonatur" required>
                    </div>
                    <div class="col-md-10">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control alamat" name="alamat" id="alamat" required>
                    </div>
                    <div class="col-md-10">
                        <label for="nohp">No HP</label>
                        <input type="text" class="form-control nohp" name="nohp" id="nohp" required>
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

<!-- Modal Delete -->
<form action="/Donatur/delete" method="post">
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
                    <input type="hidden" name="id-d" class="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end modal delete -->

<script>
    // script edit
    $('.btn-edit').on('click', function() {
        const id = $(this).data('id-donatur');
        const nama = $(this).data('nama-donatur');
        const alamat = $(this).data('alamat');
        const nohp = $(this).data('no-hp');

        $('.id-dntr').val(id);
        $('.nama').val(nama);
        $('.alamat').val(alamat);
        $('.nohp').val(nohp).trigger('change');

        $('#editModal').modal('show');
    });

    // script delete
    $('.btn-delete').on('click', function() {
        const id = $(this).data('iddonatur');
        $('.id').val(id);
        $('#deleteModal').modal('show');
    });

    // script datatable
    $(document).ready(function() {
        $('#datadonatur').DataTable();
    });
</script>
<?php $this->endSection('') ?>