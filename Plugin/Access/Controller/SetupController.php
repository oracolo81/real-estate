<?php
class SetupController extends AccessAppController {

	var $name = 'Setup';
	var $uses = array();
		
	function admin_index(){
		$this->layout = 'admin';
	}
		
	function admin_db(){
		App::import('Model', 'ConnectionManager', false);
		$db =& ConnectionManager::getDataSource('default');
		$dir = "../../app/Plugin";
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {				
				while (($folder = readdir($dh)) !== false) {
					if (is_dir($dir . "/" . $folder) && ($folder != "." || $folder != "..")) {
						$db_dump = $dir . "/" . $folder . "/db_dump/";
						if(is_dir($db_dump)){
							foreach (glob($db_dump . "*.sql") as $filename) {
								$fp = fopen($filename, "r");
								$sql = fread($fp, filesize($filename));
								if (strpos($sql, ";\n") > -1) {
									$aSql = explode(";\n", $sql);
								} else {
									$aSql = explode(";\r", $sql);
								}
								fclose($fp);
								foreach ($aSql as $sql) {
									if ($sql = trim($sql)) {
										$db->query($sql, "", $this);
									}
								}
							}
						}
					}
				}
				closedir($dh);
			}
		}
		$this->addMessage("Database setup complete");
		$this->redirect("/admin");
	}
	
}
?>