<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('content') ?>
<div class="col-sm-12">
    <div class="card m-b-60">
        <h4 class="card-header mt-0">
            Selamat Datang
        </h4>
    </div>
    <div class="card-body">
        <p class="card-text">
        <div class="alert alert-info"> Selamat datang di sistem informasi Rumah Sakit Arafah</div>
        </p>
    </div>
</div>

<?= $this->endsection('') ?>