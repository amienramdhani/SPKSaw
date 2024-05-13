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
                                        <th>ID siswa</th>
                                        <th>ID peminatan</th>
                                        <th>Nama Peminatan</th>                                        
                                        <th>Nama Siswa</th>
                                        <th>Asal Sekolah</th>
                                        <th>Alamat</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($cetak_nilai as $n): ?>

                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $n['id_siswa'] ?></td>
                                            <td><?= $n['id_peminatan'] ?></td>
                                            <td><?= $n[
                                                'nama_peminatan'
                                            ] ?></td>                                            
                                            <td><?= $n['nama_siswa'] ?></td>
                                            <td><?= $n['asal_sekolah'] ?></td>
                                            <td><?= $n['alamat'] ?></td>
                                            <td><?= $n['total'] ?></td>
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
