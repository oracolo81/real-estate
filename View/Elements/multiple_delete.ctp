<?php
	$plugin = $this->params['plugin'];
    $controller = $this->params['controller'];
?>
<script>
$(document).ready( function() {
    $('#multi_del').change(function() {
        if ($(this).val() == 'delete') {
            confirmDeleteMultiple("<?=$plugin;?>","<?=$controller;?>","delete_multiple");
        }
    });
});
</script>