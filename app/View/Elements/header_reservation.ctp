<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
      	// When the document is ready
        $(document).ready(function () {
        $('#example1').datepicker({
          dateFormat:"yy-mm-dd",
      });

    });
</script>
<div class="row headerHanging">
  <div class="col-lg-12" style="text-align:right;">
    <div class="formReservation">
      <form>
        <div id="menu-toggle-button" class="hidden-lg hidden-md">
          <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></a>
        </div>
        <div class="hidden-xs">
          <button type="submit" style="border: 0; background: transparent; margin-top:13px;">
            <a href="<?php echo $this->Html->url(array('controller' => 'Web', 'action' => 'Reservations')) ?>">
              <img src="<?php echo $this->webroot ?>img/btn_submit_triangle.png" width="27" height="27" alt="submit" />
            </a>
          </button>
        </div>
        <div class="hidden-xs">
          <label>guests</label>
          <div class="form-dropdown-style-2">
            <div class="dropdown-style-2">
              <select name="nights">
                <option>1</option>
                <option>2</option>
                <option>3</option>
              </select>
            </div>
          </div>
        </div>
        <div class="hidden-xs">
          <label>nights</label>
          <div class="form-dropdown-style-2">
            <div class="dropdown-style-2">
              <select name="nights">
                <option>1</option>
                <option>2</option>
                <option>3</option>
              </select>
            </div>
          </div>
        </div>
        <div class="hidden-xs">
          <label>check in</label>
          <div class="form">
            <input id="example1" type="text" name="checkinTime" />
          </div>
        </div>
        <a href="<?php echo $this->Html->url(array('controller' => 'Web', 'action' => 'Reservations')) ?>">
          <img src="<?php echo $this->webroot ?>img/btn_reserve_now.png" style="margin-top:-10px;float:right;margin-right:10px;" />
        </a>
      </form>
    </div>
  </div>
</div>
