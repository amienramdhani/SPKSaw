<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= $judul ?></h3>
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?= $this->session->flashdata('message') ?>
                    <div class="x_panel">

                        <div class="x_title">
                            <a href="" class="btn btn-round btn-primary mb-3" data-toggle="modal" data-target="#modalTambahPeminatan"> Tambah Peminatan</a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Peminatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($peminatan as $j): ?>

                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $j['nama_peminatan'] ?></td>
                                            <td>
                                                <a href="" class="label btn-round btn-success" data-toggle="modal" data-target="#modalEditPeminatan<?= $j[
                                                    'id_peminatan'
                                                ] ?>">edit</a>
                                                <a href="<?= base_url(
                                                    'DpSaw/hapusPeminatan/'
                                                ) .
                                                    $j[
                                                        'id_peminatan'
                                                    ] ?>" class="label btn-round btn-danger" onclick="return confirm ('Yakin?');">hapus</a>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /page content -->

    <!-- modal -->

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambahPeminatan" tabindex="-1" role="dialog" aria-labelledby="modalTambahPeminatanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modalTambahPeminatan">Tambah Peminatan</h5>
                </div>
                <?= form_open_multipart('dpSaw/peminatan') ?>

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_peminatan" name="nama_peminatan" placeholder="Nama peminatan" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-round btn-primary">Tambah</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <?php foreach ($peminatan as $j): ?>
        <div class="modal fade" id="modalEditPeminatan<?= $j[
            'id_peminatan'
        ] ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditPeminatanLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="modalEditPeminatan">Edit Peminatan</h5>
                    </div>
                    <?= form_open_multipart('dpSaw/editPeminatan') ?>
                    <input type="hidden" name="id_peminatan" value="<?= $j[
                        'id_peminatan'
                    ] ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama_peminatan" name="nama_peminatan" placeholder="Nama peminatan" value="<?= $j[
                                'nama_peminatan'
                            ] ?>" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-round btn-primary">Edit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
