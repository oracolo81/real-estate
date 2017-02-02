<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title><?php echo $title_for_layout?></title>
		<?php
			echo $this->Html->meta('icon');

			echo $this->Html->css('admin-theme');
			echo $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css');
						
			echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js');
			echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js');
			echo $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js');
			echo $this->Html->script('jquery.validate.min');

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
	</head>
	<body id="adminlogin">
		<?php echo $this->fetch('content'); ?>
	</body>
</html>