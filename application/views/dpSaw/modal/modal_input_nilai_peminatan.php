<!-- Modal Tambah -->

<?php foreach ($peminatan as $j): ?>
    <div class="modal fade" id="modalEditNilaiPeminatan<?= $j[
        'id_peminatan'
    ] ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditNilaiPeminatanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="modalEditNilaiPeminatan">Edit Nilai Peminatan</h5>
                </div>
                <?= form_open_multipart('dpSaw/nilaipeminatan') ?>
                <input type="hidden" name="id_peminatan" value="<?= $j[
                    'id_peminatan'
                ] ?>">

                <div class="modal-body">

                    <div class="form-group">
                        <select class="form-control" name="nama_peminatan" id="nama_peminatan">
                            <option value="<?= $j['nama_peminatan'] ?>">
                                <?= $j['nama_peminatan'] ?>
                            </option>
                            <?php foreach ($peminatan as $j): ?>
                                <option value="<?= $j[
                                    'nama_peminatan'
                                ] ?>"><?= $j['nama_peminatan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <input type="text" class="form-control" id="c1" name="c1" placeholder="Nilai MTK" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="c2" name="c2" placeholder="Nilai IPA" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="c3" name="c3" placeholder="Nilai Bahasa Indonesia" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="c4" name="c4" placeholder="Nilai Bahasa Inggris" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="c5" name="c5" placeholder="Nilai Tes Fisik" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="c6" name="c6" placeholder="Nilai Tes Psikologi" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="c7" name="c7" placeholder="Nilai Tes Wawancara" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="c8" name="c8" placeholder="Tes Tulis" required>
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
<?php endforeach; ?>
