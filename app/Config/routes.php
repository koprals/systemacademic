<?php
Router::connect('/', array('controller' => 'Home', 'action' => 'Index'));
Router::connect('/MeetingScape', array('controller' => 'MeetingEvents', 'action' => 'Index','2'));
Router::connect('/GroupPackages', array('controller' => 'MeetingEvents', 'action' => 'Index','3'));
Router::connect('/Weddings', array('controller' => 'MeetingEvents', 'action' => 'Index','4'));
Router::connect('/SocialEvents', array('controller' => 'MeetingEvents', 'action' => 'Index','5'));
CakePlugin::routes();
require CAKE . 'Config' . DS . 'routes.php';
Router::parseExtensions('pdf', 'json');
?>
