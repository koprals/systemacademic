<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo $this->webroot ?>img/favicon.png">

    <title>Sistem Medical Record</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->webroot ?>dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="<?php echo $this->webroot ?>dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo $this->webroot ?>assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo $this->webroot ?>css/theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo $this->webroot ?>assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Biografi Pasien</h1>
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-success">
                <div class="panel-heading">
                  <h3 class="panel-title"></h3>
                </div>
                <div class="panel-body">
                  <div class="col-sm-3">
                    <h4>Kd. Pasien</h4>
                    <h4>Nama</h4>
                    <h4>Alamat</h4>
                    <h4>Jenis Kelamin</h4>
                    <h4>Golongan Darah</h4>
                    <h4>Tempat Lahir</h4>
                    <h4>Tanggal Lahir</h4>
                  </div>
                  <div class="col-sm-4">
                    <h4><?php echo $profile['Pasien']['code']?></h4>
                    <h4><?php echo $profile['Pasien']['name']?></h4>
                    <h4><?php echo $profile['Pasien']['address']?></h4>
                    <h4>
                      <?php
                        if ($profile['Pasien']['gender'] == 0)
                        {
                          echo "Laki-Laki";
                        }else {
                          echo "Perempuan";
                        }
                      ?>
                    </h4>
                    <h4><?php echo $profile['Pasien']['gol_darah']?></h4>
                    <h4><?php echo $profile['Pasien']['place_of_birth']?></h4>
                    <h4><?php echo $profile['Pasien']['date_of_birth']?></h4>
                  </div>
                </div>
              </div>
          </div><!-- /.col-sm-4 -->
        </div>
        <div class="col-sm-5 col-xs-offset-11">
          <a href="<?php echo $settings["cms_url"]?>Web/Logout" type="button" class="btn btn-danger">Logout</a>
        </div>
      </div>

      <div class="page-header">
        <h1>Riwayat Kesehatan</h1>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Nama Dokter</th>
                <th>Keluhan</th>
                <th>Diagnosa</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($records as $records): ?>
              <tr>
                <td><?php echo $records['Admin']['fullname'] ?></td>
                <td><?php echo $records['MedicalRecord']['keluhan'] ?></td>
                <td><?php echo $records['MedicalRecord']['diagnosa'] ?></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo $this->webroot ?>assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?php echo $this->webroot ?>dist/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->webroot ?>assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo $this->webroot ?>assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
