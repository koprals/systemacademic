<?php
  $this->start('script');
?>
<script>

function makeAppointment(doctor_id, doctor_name) {
  var user_id = $("#AppointmentUserId").val();
  var patientName = $("#AppointmentUserId option:selected").text();
  if(user_id == "") {
    alert('Please pick patient');
  } else {


    //kita melakukan proses ini disini.
    if(confirm("Make appointment for " + patientName + " with " + doctor_name)) {

      $.ajax({
        url: "<?php echo $this->webroot ?>Home/makeAppointment/" + doctor_id + "/" + user_id + ".json",
        cache: false
      })
      .done(function( data ) {
        alert(data['data']['message']);
        if(data['data']['status']) {
          location.reload(true);
        }
      });

    } else {
      // tidak jadi confirm
      return false;
    }

  }
}

function cancelAppointment(appointment_id, patientName, doctor_name) {
  if(confirm("Cancel appointment for " + patientName + " with " + doctor_name)) {

    $.ajax({
      url: "<?php echo $this->webroot ?>Home/cancelAppointment/" + appointment_id + ".json",
      cache: false
    })
    .done(function( data ) {
      alert(data['data']['message']);
      if(data['data']['status']) {
        location.reload(true);
      }
    });

  } else {
    // tidak jadi confirm
    return false;
  }
}

function sendToPhotoBooth(appointment_id, patientName, doctor_name) {
  if(confirm("Send " + patientName + " for observation with " + doctor_name + "?")) {

    $.ajax({
      url: "<?php echo $this->webroot ?>Home/sendToPhotoBooth/" + appointment_id + ".json",
      cache: false
    })
    .done(function( data ) {
      alert(data['data']['message']);
      if(data['data']['status']) {
        location.reload(true);
      }
    });

  } else {
    // tidak jadi confirm
    return false;
  }
}

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

          <?php
            foreach($doctors as $doctor) {
              ?>
              <div class="widget">
                  <div class="title"><img src="<?php echo $this->webroot ?>img/icons/dark/users.png" alt="" class="titleIcon" /><h6>Waiting List - <?php echo $doctor['Admin']['fullname'] ?></h6></div>

                  <?php

                    $doctor_id = $doctor['Admin']['id'];

                    if(isset($appointments) && !empty($appointments)) {
                        foreach($appointments as $ctr => $appointment) {

                          if($appointment['Doctor']['id'] == $doctor_id) {

                            ?>
                            <div class="cLine"></div>
                            <div class="wUserInfo">
                                <a href="#" title="" class="wUserPic"><img src="<?php echo $this->webroot ?>img/user.png" alt="" /></a>
                                <ul class="leftList">
                                    <li><a href="#" title=""><strong><?php echo $appointment['Doctor']['fullname'] ?></strong></a></li>
                                    <li><a href="#" title=""><?php echo $appointment['Patient']['name'] ?></a></li>
                                    <li><a href="#" title=""><?php echo $this->Time->timeAgoInWords($appointment['Appointment']['created']) ?></a></li>
                                </ul>
                                <ul class="rightList">
                                    <li>
                                      <a href="javascript:void(0);" title="" class="button greenB" style="margin: 5px;" onclick="sendToPhotoBooth(<?php echo $appointment['Appointment']['id'] ?>, '<?php echo $appointment['Patient']['name'] ?>', '<?php echo $appointment['Doctor']['fullname'] ?>')"><img src="<?php echo $this->webroot ?>img/icons/light/check.png" alt="" class="icon">
                                        <span>Next Step</span>
                                      </a>
                                    </li>
                                    <li>
                                      <a href="javascript:void(0);" title="" class="button redB" style="margin: 5px;" onclick="cancelAppointment(<?php echo $appointment['Appointment']['id'] ?>, '<?php echo $appointment['Patient']['name'] ?>', '<?php echo $appointment['Doctor']['fullname'] ?>')"><img src="<?php echo $this->webroot ?>img/icons/light/check.png" alt="" class="icon">
                                        <span>Cancel Appointment</span>
                                      </a>
                                    </li>
                                </ul>
                            </div>
                            <?php
                          }
                        }
                    } else {
                      echo "--";
                    }
                  ?>

              </div>
              <?php
            }
          ?>

        </div>

      <!-- 2 columns widgets -->
        <div class="span6">

            <!-- Search -->
            <div class="searchWidget">

                  <div class="formRight searchDrop">
                  <?php
                      echo $this->Form->input('Appointment.user_id', array(
                        'label' => false,
                        'div' => false,
                        'class' => 'chzn-select',
                        'empty' => 'Please choose a customer',
                        'style' => 'width:100%;height:0px;',
                        'options' => $users
                      ));
                  ?>
                  </div>


            </div>

            <!-- New users widget -->
            <div class="widget">
                <div class="title"><img src="<?php echo $this->webroot ?>img/icons/dark/add.png" alt="" class="titleIcon" /><h6>Make an Appointment</h6></div>

                <?php
                  if(isset($doctors) && !empty($doctors)) {
                      foreach($doctors as $ctr => $doctor) {
                        if($ctr != 0) {
                          ?>
                          <div class="cLine"></div>
                          <?php
                        }
                        ?>
                        <div class="wUserInfo">
                            <a href="#" title="" class="wUserPic"><img src="<?php echo $this->webroot ?>img/user.png" alt="" /></a>
                            <ul class="leftList">
                                <li><a href="#" title=""><strong><?php echo $doctor['Admin']['fullname'] ?></strong></a></li>
                                <!--li><a href="#" title="">eugene@kopyov.com</a></li-->
                            </ul>
                            <ul class="rightList">
                                <li>
                                  <a href="javascript:void(0);" onclick="makeAppointment(<?php echo $doctor['Admin']['id']; ?>, '<?php echo $doctor['Admin']['fullname'] ?>')" title="" class="button blueB" style="margin: 5px;"><img src="<?php echo $this->webroot ?>img/icons/light/users2.png" alt="" class="icon">
                                    <span>Make Appointment</span>
                                  </a>
                                </li>

                            </ul>
                        </div>
                        <?php
                      }
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
