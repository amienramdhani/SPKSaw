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

                        <!-- <div class="x_title">
                            <a href="" class="btn btn-round btn-primary mb-3" data-toggle="modal" data-target="#modalTambahJurusan"> Tambah Jurusan</a>
                            <div class="clearfix"></div>
                        </div> -->
                        <div class="x_content">

                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                        <th>C6</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($nilai as $n): ?>

                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $n['C1'] ?></td>
                                            <td><?= $n['C2'] ?></td>
                                            <td><?= $n['C3'] ?></td>
                                            <td><?= $n['C4'] ?></td>
                                            <td><?= $n['C5'] ?></td>
                                            <td><?= $n['C6'] ?></td>
                                            <td>
                                                <!-- <a href="" class="label btn-round btn-success" data-toggle="modal" data-target="#modalEditJurusan<?= $j[
                                                    'id_peminatan'
                                                ] ?>">edit</a> -->
                                                <a href="<?= base_url(
                                                    'DpSaw/hapusNilai/'
                                                ) .
                                                    $n[
                                                        'id_nilai'
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
