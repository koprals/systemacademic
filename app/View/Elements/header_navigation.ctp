<?php

  $meetingAndEvents = "";
  $diningAndServices = "";
  $roomsAndSuites = "";
  $aboutUs = "";

  if($active == "meetingAndEvents") {
    $meetingAndEvents = "active";
  }

  if($active == "diningAndServices") {
    $diningAndServices = "active";
  }

  if($active == "roomsAndSuites") {
    $roomsAndSuites = "active";
  }

  if($active == "aboutUs") {
    $aboutUs = "active";
  }

?>


<div class="row header">
  <div class="col-lg-12 navigation">
    <ul>
      <li class="<?php echo $aboutUs ?>"><a href="<?php echo $this->Html->url(array('controller' => 'Web','action' => 'Abouts')) ?>"><u>About us</u></a></li>
      <li class="<?php echo $roomsAndSuites ?>"><a href="<?php echo $this->Html->url(array('controller' => 'RoomsAndSuites','action' => 'index')) ?>"><u>Rooms &amp; Suites</u></a></li>
      <li class="<?php echo $diningAndServices ?>"><a href="<?php echo $roomsAndSuites ?>"><a href="<?php echo $this->Html->url(array('controller' => 'DiningAndServices','action' => 'index')) ?>"><u>Dining &amp; Services</u></a></li>
      <li class="<?php echo $meetingAndEvents ?>"><a href="<?php echo $this->Html->url(array('controller' => 'meetingAndEvents','action' => 'index')) ?>"><u>Meeting &amp; Events</u></a></li>
    </ul>
  </div>
</div>
