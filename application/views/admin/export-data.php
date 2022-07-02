<!DOCTYPE html>
<html>

<head>

</head>

<body>
	<?php
	header("Content-type: application/vnc-ms-excel");
	header("Content-disposition: attachment; filename=Data-FittoWork.xls");
	header("Pragma: no-cache");
	header("Expire:0");

	?>
	<table border="1">
		<tr>
			<th colspan="10" style="background-color: aqua ">
				<center>DATA FIT TO WORK</center>
			</th>
		</tr>
		<tr>
			<th style="background-color: aqua">NO</th>
			<!-- <th>Tanggal Masuk</th> -->
			<th style="background-color: aqua">Nama Pegawai</th>
			<th style="background-color: aqua">NRP</th>
			<th style="background-color: aqua">Jabatan</th>
			<th style="background-color: aqua">Ket(24Jam)</th>
			<th style="background-color: aqua">Ket(48Jam)</th>
			<th style="background-color: aqua">Terjaga</th>
			<th style="background-color: aqua">Konsumsi Obat</th>
			<th style="background-color: aqua">Masalah Pribadi</th>
			<th style="background-color: aqua">Tanggal</th>

		</tr>
		<?php $no = 1;
		foreach ($fitworkdata as $data) {

		?>
			<tr>

				<td><?php echo $no++; ?></td>
				<td><?php echo $data->name; ?></td>
				<td><?php echo $data->nrp_pegawai; ?></td>
				<td><?php echo $data->jabatan; ?></td>
				<td><?php echo $data->tidur_24_jam; ?></td>
				<td><?php echo $data->tidur_48_jam; ?></td>
				<td><?php echo $data->terjaga; ?></td>
				<td><?php echo $data->konsumsi_obat; ?></td>
				<td><?php echo $data->masalah_pribadi; ?></td>
				<td><?php echo $data->created_date; ?></td>


			</tr>
		<?php  } ?>

	</table>

</body>

</html>