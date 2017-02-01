<?php
  $this->start('script');
?>
<script>

</script>
<?php
  $this->end();
?>
<!-- Title area -->
<div id="results">
</div>
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Dashboard</h5>
            <span>8th avenue Automated System.</span>
        </div>
    </div>
</div>

<div class="line"></div>

<!-- Main content wrapper -->
<div class="wrapper">

    <!-- Note -->
    <?php echo $this->Session->flash(); ?>

    <!-- Widgets -->
    <div class="fluid">
        <div class="span6">

          <div class="widget">
              <div class="title"><img src="<?php echo $this->webroot ?>img/icons/dark/users.png" alt="" class="titleIcon" /><h6>Patient List</h6></div>

              <?php
                if(isset($appointments) && !empty($appointments)) {
                    foreach($appointments as $ctr => $appointment) {
                      if($ctr != 0) {
                        ?>
                        <div class="cLine"></div>
                        <?php
                      }
                      ?>
                      <div class="wUserInfo">
                          <a href="#" title="" class="wUserPic"><img src="<?php echo $this->webroot ?>img/user.png" alt="" /></a>
                          <ul class="leftList">
                              <li><a href="#" title=""><strong><?php echo $appointment['Doctor']['fullname'] ?></strong></a></li>
                              <li><a href="#" title=""><?php echo $appointment['Patient']['name'] ?></a></li>
                              <li><a href="#" title=""><?php echo $this->Time->timeAgoInWords($appointment['Appointment']['created']) ?></a></li>
                          </ul>
                          <ul class="rightList">
                              <li>
                                <a href="<?php echo $this->Html->url(array('controller' => 'Home', 'action' => 'doTreatment', $appointment['Appointment']['id'])) ?>" title="" class="button greenB" style="margin: 5px;"><img src="<?php echo $this->webroot ?>img/icons/light/check.png" alt="" class="icon">
                                  <span>Do Treatment</span>
                                </a>
                              </li>
                          </ul>
                      </div>
                      <?php
                    }
                } else {
                  echo "--";
                }
              ?>
          </div>

        </div>

      <!-- 2 columns widgets -->
        <div class="span6">
          <div class="widget">
              <div class="title"><img src="<?php echo $this->webroot ?>img/icons/dark/users.png" alt="" class="titleIcon" /><h6>Patient List - Treatment Done</h6></div>

              <?php
                if(isset($appointments2) && !empty($appointments2)) {
                    foreach($appointments2 as $ctr => $appointment) {
                      if($ctr != 0) {
                        ?>
                        <div class="cLine"></div>
                        <?php
                      }
                      ?>
                      <div class="wUserInfo">
                          <a href="#" title="" class="wUserPic"><img src="<?php echo $this->webroot ?>img/user.png" alt="" /></a>
                          <ul class="leftList">
                              <li><a href="#" title=""><strong><?php echo $appointment['Doctor']['fullname'] ?></strong></a></li>
                              <li><a href="#" title=""><?php echo $appointment['Patient']['name'] ?></a></li>
                              <li><a href="#" title=""><?php echo $this->Time->timeAgoInWords($appointment['Appointment']['created']) ?></a></li>
                          </ul>
                          <ul class="rightList">
                              <li>
                                <a href="<?php echo $this->Html->url(array('controller' => 'Home', 'action' => 'doTreatment', $appointment['Appointment']['id'])) ?>" title="" class="button greenB" style="margin: 5px;"><img src="<?php echo $this->webroot ?>img/icons/light/check.png" alt="" class="icon">
                                  <span>Edit Data</span>
                                </a>
                              </li>
                          </ul>
                      </div>
                      <?php
                    }
                } else {
                  echo "--";
                }
              ?>
          </div>
        </div> <!-- end span 6 -->
    </div>

</div>

<!-- Footer line -->
<div id="footer">
    <div class="wrapper">k</div>
</div>
