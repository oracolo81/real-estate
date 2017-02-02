<div id="background" class="text-center">
	<h1>Internal error</h1>
	<p>A problem was encountered while processing your request.</p>
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