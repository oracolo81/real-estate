<?php if (!empty($page['body'])) { ?>
	<div class="container">
		<?php 
			$type_editor = Configure::read('type_editor');
            if ($type_editor == "markup") {
                $Parsedown = new Parsedown(); 
                echo $Parsedown->text($page['body']);
            } else {
				echo $page['body']; 
			}
		?>
	</div>
<?php } ?>
