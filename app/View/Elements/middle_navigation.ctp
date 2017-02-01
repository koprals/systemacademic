<?php
  if($typeMenu == "meetingAndEvents") {

      $meetingScape = "";
      $groupPackages = "";
      $weddings = "";
      $socialEvents = "";
      $salesTeam = "";

      if($active == "meetingScape") {
        $meetingScape = "active";
      }

      if($active == "groupPackages") {
        $groupPackages = "active";
      }

      if($active == "weddings") {
        $weddings = "active";
      }

      if($active == "socialEvents") {
        $socialEvents = "active";
      }

      if($active == "salesTeam") {
        $salesTeam = "active";
      }

      ?>
      <ul>
        <li class="<?php echo $meetingScape ?>"><a href="<?php echo $this->Html->url(array('controller' => 'meetingAndEvents', 'action' => 'meetingScape')); ?>">Meeting Scape</a></li>
        <li class="<?php echo $groupPackages ?>"><a href="<?php echo $this->Html->url(array('controller' => 'meetingAndEvents', 'action' => 'groupPackages')); ?>">Group Packages</a></li>
        <li class="<?php echo $weddings ?>"><a href="<?php echo $this->Html->url(array('controller' => 'meetingAndEvents', 'action' => 'weddings')); ?>">Weddings</a></li>
        <li class="<?php echo $socialEvents ?>"><a href="<?php echo $this->Html->url(array('controller' => 'meetingAndEvents', 'action' => 'socialEvents')); ?>">Social Events</a></li>
        <li class="<?php echo $salesTeam ?>"><a href="<?php echo $this->Html->url(array('controller' => 'meetingAndEvents', 'action' => 'salesTeam')); ?>">Sales Team</a></li>
      </ul>
      <?php
  } else if($typeMenu == "roomsAndSuites") {
    ?>
      <ul>
        <?php
          foreach($rooms as $room) {
            if($room['Room']['id'] == $active) {
              ?>
                <li class="active"><a href="<?php echo $this->Html->url(array('controller' => 'roomsAndSuites', 'action' => 'room', $room['Room']['id'])); ?>"><?php echo $room['Room']['name'] ?></a></li>
              <?php
            } else {
              ?>
                <li><a href="<?php echo $this->Html->url(array('controller' => 'roomsAndSuites', 'action' => 'room', $room['Room']['id'])); ?>"><?php echo $room['Room']['name'] ?></a></li>
              <?php
            }
          }
        ?>
      </ul>
    <?php
  } else if($typeMenu == "diningAndServices") {
    ?>
      <ul>
        <?php
          foreach($diningServices as $diningService) {
            if($diningService['DiningService']['id'] == $active) {
              ?>
                <li class="active"><a href="<?php echo $this->Html->url(array('controller' => 'diningAndServices', 'action' => 'services', $diningService['DiningService']['id'])); ?>"><?php echo $diningService['DiningService']['name'] ?></a></li>
              <?php
            } else {
              ?>
                <li><a href="<?php echo $this->Html->url(array('controller' => 'diningAndServices', 'action' => 'services', $diningService['DiningService']['id'])); ?>"><?php echo $diningService['DiningService']['name'] ?></a></li>
              <?php
            }
          }
        ?>
      </ul>
    <?php
  }
?>
