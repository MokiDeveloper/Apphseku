<div class="bg-white p-3 shadow-sm mx-3">
  <div class="d-block">
    <h5 class="d-inline">Data Fit To Work</h5>
    <!-- Message If Action -->
    <?= $this->session->flashdata('pesan'); ?>
  </div>
  <div class="col card-header text-right">
    <a target="_blank" href="<?php echo base_url('exportdata/export'); ?>" class="btn btn btn-success plus"><i class="fa fa-download"></i> Export Data</span>
    </a>

  </div>
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
          <!-- <th>Tanggal</th> -->

        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($laporanfit as $s) { ?>
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

          <?php  } ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>