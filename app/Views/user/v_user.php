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
                        <h4 class="mt-0 header-title">Data User</h4>
                    </div>
                    <div class="card-body">

                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-outline-primary" data-target="#addModal" data-toggle="modal">Tambah Data</button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datauser">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>Nama User</th>
                                                <th>Email</th>
                                                <th>Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($user as $val) {
                                                $no++; ?>
                                                <tr role="row" class="odd">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $val['nama_user'] ?></td>
                                                    <td><?= $val['email'] ?></td>
                                                    <td><?= $val['level'] ?></td>
                                                    <td>

                                                        <button type="button" class="btn btn-outline-dark btn-sm btn-edit" data-id_user="<?= $val['id_user']; ?>" data-nama_user="<?= $val['nama_user']; ?>" data-email="<?= $val['email']; ?>" data-password="<?= $val['password']; ?>" data-level="<?= $val['level']; ?>">
                                                            <i class=" fa fa-tags"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-danger btn-sm btn-delete" data-id_user="<?= $val['id_user']; ?>">
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
<form action="/user/save" method="post" autocomplete="off">
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
                        <input type="hidden" class="form-control" name="id" id="iduser">
                    </div>
                    <div class="col-md-10">
                        <label for="nmuser">Nama User</label>
                        <input type="text" class="form-control" name="namauser" id="nmuser" required>
                    </div>
                    <div class="col-md-10">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="col-md-10">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" name="pass" id="pass" required>
                    </div>
                    <div class="col-md-10">
                        <label for="nohp">Level</label>
                        <input type="text" class="form-control" name="level" id="level" required>
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
<form action="/user/edit" method="post" autocomplete="off">
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-10">
                        <input type="hidden" class="form-control iduser" name="id" id="iduser">
                    </div>
                    <div class="col-md-10">
                        <label for="nmuser">Nama User</label>
                        <input type="text" class="form-control nmuser" name="namauser" id="nmuser" required>
                    </div>
                    <div class="col-md-10">
                        <label for="email">Email</label>
                        <input type="email" class="form-control email" name="email" id="email" required>
                    </div>
                    <div class="col-md-10">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control pass" name="pass" id="pass" required>
                    </div>
                    <div class="col-md-10">
                        <label for="nohp">Level</label>
                        <input type="text" class="form-control level" name="level" id="level" required>
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
<form action="/user/delete" method="post">
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
                    <input type="hidden" name="idu" class="id">
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
        const id = $(this).data('id_user');
        const nama = $(this).data('nama_user');
        const email = $(this).data('email');
        const pswd = $(this).data('password');
        const lvl = $(this).data('level');

        $('.iduser').val(id);
        $('.nmuser').val(nama);
        $('.email').val(email);
        $('.pass').val(pswd);
        $('.level').val(lvl).trigger('change');

        $('#editModal').modal('show');
    });

    // script delete
    $('.btn-delete').on('click', function() {
        const id = $(this).data('id_user');
        $('.id').val(id);
        $('#deleteModal').modal('show');
    });

    // script datatable
    $(document).ready(function() {
        $('#datauser').DataTable();
    });
</script>
<?php $this->endSection('') ?>