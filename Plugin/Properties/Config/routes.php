<?php
	Router::connect('/admin/properties/', array('prefix' => 'admin', 'plugin' => 'properties', 'controller' => 'manage', 'action' => 'index'));
	Router::connect('/admin/properties', array('prefix' => 'admin', 'plugin' => 'properties', 'controller' => 'manage', 'action' => 'index'));
?>