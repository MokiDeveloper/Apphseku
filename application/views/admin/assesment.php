
<div class="bg-white p-3 shadow-sm mx-3">
	<div class="d-block">
		<h5 class="d-inline">Data Self Assesment</h5>
    <!-- Message If Action -->
    <?= $this->session->flashdata('pesan'); ?>
	</div>
	<div class="table-responsive mt-3">
		<table class="table table-striped table-bordered table-hover" id="table">
			<thead class="bg-primary text-white">
        <tr>
                    <th>No.</th>
                    <th>IDPegawai</th>
                    <th>Nama Pegawai</th>
                    <th>Jabatan</th>
                    <th>Subcount</th>
                    <th>Alamat</th>
                    <th class="text-center">Info Klinis 1</th>
                    <th class="text-center">Info Klinis 2</th>
                    <th class="text-center">Info Klinis 3</th>
                    <!-- <th class="text-center">Info Klinis 4</th> -->
                    <th>Kontak Positif</th>
                    <th>Info Sakit</th>
                    <th>Riwayat Perjalanan</th>
                    <th>Tanggal Perjalanan</th>
                    <th>Riwayat Kunjungan</th>
                    <th>Tanggal Perjalanan</th>
                    <th>Tanggal Ke Rumah</th>
                    <th>Transportasi</th>
                    <th>Transit</th>
                    <th>Action</th>
        </tr>
      </thead>
      <tbody>
         <?php
            $no = 1;
            foreach ($xkes as $s) { ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $s->id_pegawai ?></td>
          <td><?= $s->nama ?></td>
          <td><?= $s->jabatan ?></td>
          <td><?= $s->subcont ?></td>
          <td><?= $s->alamat ?></td>
          <td><?= $s->info_klinis1 ?></td>
          <td><?= $s->info_klinis3 ?></td>
          <td><?= $s->info_klinis4 ?></td>
          <td><?= $s->kontak_positif ?></td>
          <td><?= $s->info_sakit ?></td>
          <td><?= $s->riwayat_perjalanan ?></td>
          <td><?= $s->tggl_perjalanan ?></td>
          <td><?= $s->riwayat_kunjung ?></td>
          <td><?= $s->tggl_kunjung ?></td>
          <td><?= $s->tanggal_kerumah ?></td>
          <td><?= $s->transportasi ?></td>
          <td><?= $s->transit ?></td>
          <td>
                                    <div class="form-group">
                                    <!-- <a href="<?= base_url('admin/edit/'.$s->id_pegawai); ?>" data-toogle="tooltip" title="Edit" class="btn btn-small text-danger"><i class=" fa fa-pen text-primary"></i> </a> -->
                                    <a href="#" data-toogle="tooltip" title="Edit" class="btn btn-small text-danger"><i class=" fa fa-pen text-primary"></i> </a>
                                    
                                    <a type="submit" href="<?= base_url('admin/del/'.$s->id_pegawai); ?>" data-toogle="tooltip" title="Hapus" onclick="return confirm('Anda yakin akan menghapus data?')" class="btn btn-small text-danger"><i class="fa fa-trash"></i></a>
                                  </div>
          </td>
        </tr>
        <?php  } ?>
      </tbody>
		</table>
    </div>
</div>
<br/>
<!-- <script>
    $(document).ready(function(){
        // Setup datatables
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
      {
          return {
              "iStart": oSettings._iDisplayStart,
              "iEnd": oSettings.fnDisplayEnd(),
              "iLength": oSettings._iDisplayLength,
              "iTotal": oSettings.fnRecordsTotal(),
              "iFilteredTotal": oSettings.fnRecordsDisplay(),
              "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
              "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
          };
      };
 
      var table = $("#table").dataTable({
          initComplete: function() {
              var api = this.api();
              $('#table_filter input')
                  .off('.DT')
                  .on('input.DT', function() {
                      api.search(this.value).draw();
              });
          },
              oLanguage: {
              sProcessing: "loading..."
          },
              processing: true,
              serverSide: true,
              ajax: {
                  "url": "<?php echo base_url().'ajax/assesment'?>", 
                  "type": "POST"
            },
                    columns: [
                                                {"data": "id_pegawai", "name": "tb_kesehatan.id_pegawai"},
                                                {"data": "nama", "name": "tb_kesehatan.nama"},
                                                {"data": "nrp", "name": "tb_kesehatan.nrp"},
                                                {"data": "jabatan", "name": "tb_kesehatan.jabatan"},
                                                {"data": "subcont", "name": "tb_kesehatan.subcont"},
                                                {"data": "alamat", "name": "tb_kesehatan.alamat"},
                  ],
                order: [[1, 'asc']],
          rowCallback: function(row, data, iDisplayIndex) {
              var info = this.fnPagingInfo();
              var page = info.iPage;
              var length = info.iLength;
              $('td:eq(0)', row).html();
          }
 
      });
            // end setup datatables
            // End delete Records
    });
</script> -->