<?php
  if(!isset($prizesActive)) {
    $prizesActive = "";
  }

  if(!isset($blogActive)) {
    $blogActive = "";
  }

  if(!isset($leaderboardActive)) {
    $leaderboardActive = "";
  }

  if(!isset($miniGameActive)) {
    $miniGameActive = "";
  }

  if(!isset($profileActive)) {
    $profileActive = "";
  }

  if(!isset($diningPromoActive)) {
    $diningPromoActive = "";
  }

?>


<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top"><img class="img-responsive lazy" src="" data-src="<?php echo $this->webroot ?>img/logo3.jpg"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="<?php echo $profileActive; ?>">
                    <?php echo $this->Html->link('Home', array('action' => 'Profile')) ?>
                </li>
                <li class="<?php echo $miniGameActive; ?>">
                  <?php echo $this->Html->link('Mini Game', array('action' => 'MiniGame')) ?>
                </li>
                <li class="<?php echo $leaderboardActive; ?>">
                  <?php echo $this->Html->link('Leaderboard', array('action' => 'Leaderboard')) ?>
                </li>
                <li class="<?php echo $blogActive; ?>">
                  <?php echo $this->Html->link('Blog', array('action' => 'Blog')) ?>
                </li>
                <li class="<?php echo $prizesActive; ?>">
                  <?php echo $this->Html->link('Prizes', array('action' => 'Prizes')) ?>
                </li>
                <li class="<?php echo $diningPromoActive; ?>">
                  <?php echo $this->Html->link('Online Promo', array('action' => 'DiningPromo')) ?>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
