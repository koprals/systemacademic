<style>
tr{
	height:30px;
	vertical-align:middle;
	padding-left:10px;
}
tr.header{
	background-color:#999999;
	font-weight:bold;
	font-size:16px;
}

tr.ganjil{
	background-color:#ffffff;
	font-weight:normal;
	font-size:14px;
}
tr.genap{
	background-color:#F0F0F0;
	font-weight:normal;
	font-size:14px;
}


</style>

<h2 style="text-align:left;">Laporan Registrasi Pasien</h2>
<table border="1" cellspacing="0" cellpadding="0">
	<tr class="header">
		<td style="text-align:center;">No</td>
		<td width="50" style="text-align:center;">Id</td>
    <td width="100">Kode Pasien</td>
		<td width="150">Nama Pasien</td>
		<td width="250">Alamat</td>
		<td width="150">Jenis Kelamin</td>
		<td width="150">Nomor Telefon</td>
		<td width="150">Tempat Lahir</td>
    <td width="150">Tanggal Lahir</td>
    <td width="200">Created</td>
	</tr>

	<?php if(!empty($data)):?>
	<?php $count = 0;?>
	<?php foreach($data as $data): ?>
	<?php $count++;?>
	<?php $no		=	(($page-1)*$viewpage) + $count;?>
	<?php $class = ($count % 2 == 0) ? "ganjil" : "genap";?>
  	<tr class="<?php echo $class?>">
		<td style="text-align:center;"><?php echo $no ?></td>
		<td style="text-align:center;"><?php echo $data[$ModelName]['id']?></td>
		<td><?php echo $data[$ModelName]['code']?></td>
		<td><?php echo $data[$ModelName]['name']?></td>
		<td><?php echo $data[$ModelName]['address']?></td>
		<td>
			<?php
				if($data[$ModelName]['gender'] = 0){
					echo "Laki-Laki";
				}else {
					echo "Wanita";
				}
			?>
		</td>
		<td><?php echo $data[$ModelName]['phone']?></td>
		<td><?php echo $data[$ModelName]['place_of_birth']?></td>
		<td><?php echo date('d.m.y', strtotime($data[$ModelName]['date_of_birth']))?></td>
		<td><?php echo $this->Time->nice($data[$ModelName]['created'])?></td>
	</tr>
	<?php endforeach;?>
	<?php else:?>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php endif;?>
</table>
