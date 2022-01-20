<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Report Absensi</title>
	<style type="text/css">
		.text-center {
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="container p-3">
		<div>	
			<h2 class="text-center mb-0">Data Absensi</h2>
			<p class="text-center">( {{ $absensi[0]->univ->nama_univ }} )</p>
		</div>
		<table border="1" cellspacing="0" width="100%" cellpadding="5"> 
			<tr>
				<th width="5%">No.</th>
				<th >Nama</th>
				<th >Universitas</th>
				<th width="5%">Kehadiran</th>
				<th >Kegiatan</th>
			</tr>
			<?php $no=1; ?>
			<?php foreach ($absensi as $val) : ?>
					<tr>
						<td ><?= $no++ ?></td>
						<td ><?= $val->nama ?></td>
						<td ><?= $val->univ->nama_univ ?? '' ?></td>
						<td class="text-center"><?= $val->kehadiran ?></td>
						<td>
							<ol style="margin-left: -20px;  padding-inline-start:0px">
								<?php foreach ($val->absensi as $row): ?>
									<li style="margin:5px">{{ $row->kegiatan->nama_kegiatan ?? ''}}</li>
								<?php endforeach ?>
							</ol>
						</td>
					</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<footer>
		<span style="float: right;">	
			Tanggal eksport : {{ date('d-m-Y H:i') }}
		</span>
	</footer>
</body>
</html>