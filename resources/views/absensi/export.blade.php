<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Report Absensi</title>
	<style type="text/css">
		.text-center {
			text-align: center;
		}
		.mb-0 {
			margin-bottom: 0;
		}
		footer {
			font-size: 0.9rem;
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
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
								<?php foreach ($val->absensi as $row): ?>
									{{ $row->kegiatan->nama_kegiatan ?? ''}}
								<?php endforeach ?>
							
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