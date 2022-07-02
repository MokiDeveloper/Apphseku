
<div class="bg-white p-3 shadow-sm mx-3">
	<div class="d-block">
		<h5 class="d-inline">Tabel Pegawai</h5>
	</div>
	<div class="table-responsive mt-3">
		<table class="table table-striped table-bordered table-hover" id="table">
			<thead class="bg-primary text-white">
				<tr>
                    <th>ID</th>
                    <th>Nama Pegawai</th>
                    <th>NRP</th>
                    <th>Jabatan</th>
                    <th>Subcount</th>
                    <th>Alamat</th>
				</tr>
			</thead>
		</table>
    </div>
</div>
<br/>
<script>
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
                  "url": "<?php echo base_url().'ajax/pegawai'?>", 
                  "type": "POST"
            },
                    columns: [
                                                {"data": "id_pegawai", "name": "tb_pegawai.id_pegawai"},
                                                {"data": "nama", "name": "tb_pegawai.nama"},
                                                {"data": "nrp", "name": "tb_pegawai.nrp"},
                                                {"data": "jabatan", "name": "tb_pegawai.jabatan"},
                                                {"data": "subcont", "name": "tb_pegawai.subcont"},
                                                {"data": "alamat", "name": "tb_pegawai.alamat"},
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
</script>