<script type="text/javascript">
      	// When the document is ready
        $(document).ready(function () {
        $('#ReservationCheckIn').datepicker({
          dateFormat:"yy-mm-dd",
        });
        $('#ReservationCheckOut').datepicker({
          dateFormat:"yy-mm-dd",
        });

    });
</script>
<!-- Page Content -->
<div id="page-content-wrapper">
  <div id="main-content">
    <div class="container-fluid">
        <?php
          echo $this->element('header_reservation');
        ?>
        <?php
          echo $this->element('header_navigation', array(
            "active" => ""
          ));
        ?>
        <div class="row">
          <div class="col-md-10 col-md-offset-1 diningCarousel" >
            <?php
              echo $this->element('slider_advertisement');
            ?>
          </div>
        </div>
        <div class="row innerMenuHr">
          <div class="col-md-10 col-md-offset-1 text-center">
            <div class="innerMenuTitle">
              <h1>Reservation</h1>
            </div>
          </div>
        </div>
        <div class="clearfix" style="height:55px;">
          <br>
        </div>
        <?php
          echo $this->element('middle_content_page', array(
            'page' => $page
          ));
        ?>

        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <?php echo $this->Form->create('Reservation', array('url' => array("controller"=>"web", "action"=>"Reservations"),'class' => 'form-horizontal')); ?>
            <div class="clearfix" style="height:30px;">
              <br>
            </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Check In</label>
                    <?php
                      echo $this->Form->input('check_in', array(
                        'label' =>  false,
                        'class' => 'form-control',
                        'div'   =>  false,
                        'placeholder' =>  'Check In',
                        'between' =>  '<div class="col-xs-4">',
                        'after'   => '</div>',
                        'error' => array(
                            'attributes' => array('wrap' => 'p', 'class' => 'help-block text-danger')
                        ),
                        'type' => 'text'
                      ));
                    ?>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 control-label">Check Out</label>
                    <?php
                      echo $this->Form->input('check_out', array(
                        'label' =>  false,
                        'div'   =>  false,
                        'type'  =>  'text',
                        'class' => 'form-control',
                        'placeholder' =>  'Check Out',
                        'between' =>  '<div class="col-xs-4">',
                        'after'   => '</div>',
                        'error' => array(
                            'attributes' => array('wrap' => 'p', 'class' => 'help-block text-danger')
                        )
                      ));
                    ?>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Reservation Type</label>
                    <?php
                      echo $this->Form->input('reservation_type_id', array(
                        'label' =>  false,
                        'div'   =>  false,
                        'class' => 'form-control',
                        'between' =>  '<div class="col-xs-3">',
                        'after'   => '</div>',
                        'options' => $revtype_ids,
                        'error' => array(
                            'attributes' => array('wrap' => 'p', 'class' => 'help-block text-danger')
                        )
                      ));
                    ?>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 control-label">Room</label>
                    <?php
                      echo $this->Form->input('room_id', array(
                        'label' =>  false,
                        'div'   =>  false,
                        'class' => 'form-control',
                        'between' =>  '<div class="col-xs-3">',
                        'after'   => '</div>',
                        'options' => $room_ids,
                        'error' => array(
                            'attributes' => array('wrap' => 'p', 'class' => 'help-block text-danger')
                        )
                      ));
                    ?>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 control-label">Full Name</label>
                    <?php
                      echo $this->Form->input('name', array(
                        'label' =>  false,
                        'div'   =>  false,
                        'type'  =>  'text',
                        'class' => 'form-control',
                        'placeholder' =>  'Full Name',
                        'between' =>  '<div class="col-xs-4">',
                        'after'   => '</div>',
                        'error' => array(
                            'attributes' => array('wrap' => 'p', 'class' => 'help-block text-danger')
                        )
                      ));
                    ?>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 control-label">Email</label>
                    <?php
                      echo $this->Form->input('email', array(
                        'label' =>  false,
                        'div'   =>  false,
                        'type'  =>  'text',
                        'class' => 'form-control',
                        'placeholder' =>  'Email',
                        'between' =>  '<div class="col-xs-4">',
                        'after'   => '</div>',
                        'error' => array(
                            'attributes' => array('wrap' => 'p', 'class' => 'help-block text-danger')
                        )
                      ));
                    ?>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 control-label">Phone Number</label>
                    <?php
                      echo $this->Form->input('phone_number', array(
                        'label' =>  false,
                        'div'   =>  false,
                        'type'  =>  'text',
                        'class' => 'form-control',
                        'placeholder' =>  'Phone Number',
                        'between' =>  '<div class="col-xs-4">',
                        'after'   => '</div>',
                        'error' => array(
                            'attributes' => array('wrap' => 'p', 'class' => 'help-block text-danger')
                        )
                      ));
                    ?>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 control-label">Adult</label>
                    <?php
                      echo $this->Form->input('adult', array(
                        'label' =>  false,
                        'div'   =>  false,
                        'class' => 'form-control',
                        'between' =>  '<div class="col-xs-3">',
                        'after'   => '</div>',
                        'options' => array(1, 2, 3),
                        'error' => array(
                            'attributes' => array('wrap' => 'p', 'class' => 'help-block text-danger')
                        )
                      ));
                    ?>
                </div>

                <div class="form-group">
                    <label class="col-xs-3 control-label">Children</label>
                    <?php
                      echo $this->Form->input('children', array(
                        'label' =>  false,
                        'div'   =>  false,
                        'class' => 'form-control',
                        'between' =>  '<div class="col-xs-3">',
                        'after'   => '</div>',
                        'options' => array(1, 2, 3),
                        'error' => array(
                            'attributes' => array('wrap' => 'p', 'class' => 'help-block text-danger')
                        )
                      ));
                    ?>
                </div>
                <div class="form-group">
                    <div class="col-xs-9 col-xs-offset-3">
                        <button type="submit" class="button-book-now">Submit</button>
                    </div>
                </div>
            <?php echo $this->Form->end(); ?>
          </div>
        </div>
        <div class="clearfix" style="height:55px;">
          <br>
        </div>
        <div class="row footer">
          <?php echo $this->element('footer_sosmed'); ?>
        </div>
    </div>
  </div>
</div>
<!-- /#page-content-wrapper -->
