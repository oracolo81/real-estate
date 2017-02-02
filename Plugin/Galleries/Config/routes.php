<?php
	Router::connect('/admin/galleries/', array('prefix' => 'admin', 'plugin' => 'galleries', 'controller' => 'manage', 'action' => 'index'));
	Router::connect('/admin/galleries', array('prefix' => 'admin', 'plugin' => 'galleries', 'controller' => 'manage', 'action' => 'index'));
?>