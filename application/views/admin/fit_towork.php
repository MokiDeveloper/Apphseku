<div class="bg-white p-3 shadow-sm mx-3">
  <div class="d-block">
    <h5 class="d-inline">Data Fit To Work</h5>
    <!-- Message If Action -->
    <?= $this->session->flashdata('pesan'); ?>
  </div>
  <div class="col card-header text-right">


  </div>
  <?php echo form_open_multipart('admin/edit_fit') ?>
  <div class="table-responsive mt-3">
    <table class="table table-striped table-bordered table-hover" id="example">
      <thead class="bg-primary text-white">
        <tr>
          <th>#</th>
          <!-- <th>ID</th> -->
          <th>Nama Pegawai</th>
          <th>NRP</th>
          <th>Jabatan</th>
          <th>Ket(24Jam)</th>
          <th>Ket(48Jam)</th>
          <th>Terjaga</th>
          <th>Konsumsi Obat</th>
          <th>Masalah Pribadi</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($fitworkdata as $s) { ?>
          <tr>
            <td><?= $no++ ?></td>
            <!-- <td><?= $s->id_pegawai ?></td> -->
            <td><?= $s->name ?></td>
            <td><?= $s->nrp_pegawai ?></td>
            <td><?= $s->jabatan ?></td>
            <td><?= $s->tidur_24_jam ?></td>
            <td><?= $s->tidur_48_jam ?></td>
            <td><?= $s->terjaga ?></td>
            <td><?= $s->konsumsi_obat ?></td>
            <td><?= $s->masalah_pribadi ?></td>
            <td>
              <div class="form-group">
                <a href="#" data-toogle="tooltip" title="Edit" class="btn btn-small text-danger" data-toggle="modal" data-target="#modaledit<?= $s->id ?>" data-id="<?php echo $s->id; ?>" data-name="<?php echo $s->name; ?>" data-nrp="<?php echo $s->nrp_pegawai; ?>" data-jabatan="<?php echo $s->jabatan; ?>" data-tidur24="<?php echo $s->tidur_24_jam; ?>" data-tidur48="<?php echo $s->tidur_48_jam; ?>" data-terjaga="<?php echo $s->terjaga; ?>" data-konsumsi="<?php echo $s->konsumsi_obat; ?>" data-masalah="<?php echo $s->masalah_pribadi; ?>">
                  <i class=" fa fa-pen text-primary"></i>
                </a>
                <a type="submit" href="<?= base_url('admin/del_fit/' . $s->id); ?>" data-toogle="tooltip" title="Hapus" onclick="return confirm('Anda yakin akan menghapus data?')" class="btn btn-small text-danger"><i class="fa fa-trash"></i></a>
              </div>
            </td>
          </tr>
        <?php  } ?>
      </tbody>
    </table>
  </div>


  <?php
  if ($fitworkdata) {
    foreach ($fitworkdata as $v) {
  ?>
      <div class="modal fade" id="modaledit<?= $v->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!-- di dalam modal-body terdapat 4 form input yang berisi data. data-data tersebut ditampilkan sama seperti menampilkan data pada tabel. -->
            <div class="modal-body">
              <form action="<?php echo base_url('admin/edit_fit') ?>" method="post">
                <input type="hidden" value="<?php echo $v->id; ?>" id="id">
                <div class="form-group">
                  <label for="exampleFormControlInput1">Nama Pegawai</label>
                  <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" value="<?php echo $v->name; ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">NRP</label>
                  <textarea class="form-control" rows="5" name="nrp" id="nrp"><?php echo $v->nrp_pegawai; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Jabatan</label>
                  <input type="text" class="form-control" name="jabatan" id="jabatan" value="<?php echo $v->jabatan; ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Keterangan (24 Jam)</label>
                  <input type="text" class="form-control" name="ket_24" id="ket_24" value="<?php echo $v->tidur_24_jam; ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Keterangan (48 Jam)</label>
                  <input type="text" class="form-control" name="ket_48" id="ket_48" value="<?php echo $v->tidur_48_jam; ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Terjaga</label>
                  <input type="text" class="form-control" name="terjaga" id="terjaga" value="<?php echo $v->terjaga; ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Keterangan Obat</label>
                  <input type="text" class="form-control" name="konsumsi_obat" id="konsumsi_obat" value="<?php echo $v->konsumsi_obat; ?>">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Masalah Pribadi</label>
                  <input type="text" class="form-control" name="masalah_pribadi" id="masalah_pribadi" value="<?php echo $v->masalah_pribadi; ?>">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
              </form>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
  <?php
    }
  }
  ?>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();

    $('#modaledit').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var id = button.data('id')
      var name = button.data('name')
      var nrp = button.data('nrp')
      var jabatan = button.data('jabatan')
      var tidur24 = button.data('tidur24')
      var tidur48 = button.data('tidur48')
      var terjaga = button.data('terjaga')
      var konsumsi = button.data('konsumsi')
      var masalah = button.data('masalah')
      var modal = $(this)

      modal.find('#id').val(id)
      modal.find('#nama_pegawai').val(name)
      modal.find('#nrp').val(nrp)
      modal.find('#jabatan').val(jabatan)
      modal.find('#ket_24').val(tidur24)
      modal.find('#ket_48').val(tidur48)
      modal.find('#terjaga').val(terjaga)
      modal.find('#konsumsi_obat').val(konsumsi)
      modal.find('#masalah_pribadi').val(masalah)
      // modal.find('#harga_barang').val(harga_barang)
    })
  });
</script>