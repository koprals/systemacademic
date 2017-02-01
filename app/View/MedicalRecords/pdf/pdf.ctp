<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial, Helvetica, sans-serif;">
    <tr>
    	<td align="center">
        <h1 style="font-weight:bold;margin:5px;">KILINIK PRATAMA PANTI NUGRAHA</h2>
        <h2 style="font-size:16px;font-weight:bold;margin:5px;">Jakarta-Indonesia</h2>
      </td>
    </tr>
    <tr>
      <td>_____________________________________________________________________________</td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td align="center">
        <h2 style="font-size:16px;font-weight:bold;margin:5px;">Medical Record Pasien</h2>
      </td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:10px;">
          <tr>
            <td width="50%">Kode Pasien &nbsp;&nbsp;&nbsp;: <?php echo $detail['Pasien']['code']; ?></td>
            <td width="50%">&nbsp;</td>
          </tr>
          <tr>
            <td>Nama Pasien &nbsp;&nbsp;&nbsp;: <?php echo $detail['Pasien']['name']; ?></td>
            <td>Tanggal Medical Record &nbsp;&nbsp;&nbsp;: <?php echo $detail[$ModelName]['created'] ?></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr style="page-break-before: auto">
    	<td>
        	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0px solid #000;border-collapse:collapse;">
            	<tr>
                	<td height="26" width="3%" align="center" style="border:1px solid #000;border-collapse:collapse;">
                    	<h5 style="font-size:10px;font-weight:bold;margin:5px;">ID</h5>
                    </td>
                	<td width="10%" align="center" style="border:1px solid #000;border-collapse:collapse;">
                    	<h5 style="font-size:10px;font-weight:bold;margin:5px;">Kode Pasien</h5>
                    </td>
                	<td width="22%" align="center" style="border:1px solid #000;border-collapse:collapse;">
                    	<h5 style="font-size:10px;font-weight:bold;margin:5px;">Keluhan</h5>
                    </td>
                	<td width="22%" align="center" style="border:1px solid #000;border-collapse:collapse;">
                    	<h5 style="font-size:10px;font-weight:bold;margin:5px;">Diagnosa</h5>
                    </td>
                </tr>
                <tr>
                  	<td height="26" width="3%" align="center" style="border:1px solid #000;border-collapse:collapse;">
                      	<h5 style="font-size:10px;font-weight:bold;margin:5px;"><?php echo $detail[$ModelName]['id'] ?></h5>
                      </td>
                  	<td width="10%" align="center" style="border:1px solid #000;border-collapse:collapse;">
                      	<h5 style="font-size:10px;font-weight:bold;margin:5px;"><?php echo $detail['Pasien']['code'] ?></h5>
                      </td>
                  	<td width="22%" align="left" style="border:1px solid #000;border-collapse:collapse;">
                      	<h5 style="font-size:10px;font-weight:bold;margin:5px;"><?php echo $detail[$ModelName]['keluhan'] ?></h5>
                      </td>
                  	<td width="22%" align="left" style="border:1px solid #000;border-collapse:collapse;">
                      	<h5 style="font-size:10px;font-weight:bold;margin:5px;"><?php echo $detail[$ModelName]['diagnosa'] ?></h5>
                      </td>
                  </tr>
            </table>
        </td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr align="right">
      <td>
        <h4 style="font-size:12px">Dokter Yang Memeriksa</h4>
      </td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td align="right">_______________</td>
    </tr>
    <tr>
      <td align="right" style="font-size:12px"><?php echo $detail['Admin']['fullname'] ?></td>
    </tr>
    <tr>
      <td style="font-size:10px;font-weight:bold;">
        &nbsp;
      </td>
    </tr>
</table>
