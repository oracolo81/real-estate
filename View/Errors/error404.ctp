<div id="background" class="text-center">
	<h1>Page not found</h1>
	<p>The page you are looking for was not found on the server.</p>
	<p>Please head over to our <a href="/">homepage</a>.</p>
	<h2><?php echo $message; ?></h2>
	<p class="error">
		<strong><?php echo __d('cake', 'Error'); ?>: </strong>
		<?php printf(
			__d('cake', 'The requested address %s was not found on this server.'),
			"<strong>'{$url}'</strong>"
		); ?>
	</p>
</div>