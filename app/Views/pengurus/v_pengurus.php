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
                        <h4 class="mt-0 header-title">Data Pengurus</h4>
                    </div>
                    <div class="card-body">

                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModal" data-toggle="modal">Tambah Data</button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datapengurus">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Nama Pengurus</th>
                                                <th>Jabatan</th>
                                                <th>Alamat</th>
                                                <th>NoHp</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($pengurus as $val) {
                                                $no++; ?>
                                                <tr role="row" class="odd">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $val['id_pengurus'] ?></td>
                                                    <td><?= $val['nama_pengurus'] ?></td>
                                                    <td><?= $val['jabatan'] ?></td>
                                                    <td><?= $val['alamat'] ?></td>
                                                    <td><?= $val['no_hp'] ?></td>
                                                    <td>

                                                        <button type="button" class="btn btn-info btn-sm btn-edit" data-id_pengurus="<?= $val['id_pengurus']; ?>" data-nama_pengurus="<?= $val['nama_pengurus']; ?>" data-jabatan="<?= $val['jabatan']; ?>" data-alamat="<?= $val['alamat']; ?>" data-no_hp="<?= $val['no_hp']; ?>">
                                                            <i class=" fa fa-tags"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id_pengurus="<?= $val['id_pengurus']; ?>">
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
<form action="/pengurus/save" method="post" autocomplete="off">
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
                        <label for="idpgrs">ID Pengurus</label>
                        <input type="text" class="form-control " name="id" id="idpgrs" required>
                    </div>
                    <div class="col-md-10">
                        <label for="namapgrs">Nama Pengurus</label>
                        <input type="text" class="form-control" name="namapengurus" id="namapgrs" required>
                    </div>
                    <div class="col-md-10">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" id="jabatan" required>
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
<form action="/pengurus/edit" method="post" autocomplete="off">
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-10">
                        <label for="idpgrs">ID Pengurus</label>
                        <input type="text" class="form-control idpgrs" name="idp" id="idpgrs" required >
                    </div>
                    <div class="col-md-10">
                        <label for="namapgrs">Nama Pengurus</label>
                        <input type="text" class="form-control nama" name="namapengurus" id="namapgrs" required>
                    </div>
                    <div class="col-md-10">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" class="form-control jabatan" name="jabatan" id="jabatan" required>
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
<form action="/pengurus/delete" method="post">
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
                    <input type="hidden" name="idp" class="id">
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
        const id = $(this).data('id_pengurus');
        const nama = $(this).data('nama_pengurus');
        const jabatan = $(this).data('jabatan');
        const alamat = $(this).data('alamat');
        const nohp = $(this).data('no_hp');

        $('.idpgrs').val(id);
        $('.nama').val(nama);
        $('.jabatan').val(jabatan);
        $('.alamat').val(alamat);
        $('.nohp').val(nohp).trigger('change');

        $('#editModal').modal('show');
    });

    // script delete
    $('.btn-delete').on('click', function() {
        const id = $(this).data('id_pengurus');
        $('.id').val(id);
        $('#deleteModal').modal('show');
    });

    // script datatable
    $(document).ready(function() {
        $('#datapengurus').DataTable();
    });
</script>
<?php $this->endSection('') ?>