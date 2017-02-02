<?php
class FileManagerComponent extends Component {

	public $components = array('ResizeImage');

	public function create($options = array()) {
		$this->sPath = isset($options["path"]) ? $options["path"] : "";
		$this->sAbsolutePath = isset($options["absolute_path"]) ? $options["absolute_path"] :  ROOT . DS . APP_DIR . $this->sPath;
		$this->sAbsoluteThumbPath = isset($options["absolute_thumb_path"]) ? $options["absolute_thumb_path"] : ROOT . DS . APP_DIR . $this->sPath . 'thumb/';
	}
	
	public function save($fileUploaded, $aSettings = array()) {
		$this->sFileUploaded = $fileUploaded["name"];
		$this->sTempFile = $fileUploaded["tmp_name"];
		$this->aSettings = $aSettings;
		$this->bFileUploaded = false;
		$this->_uploadFile();
	}
	
	public function delete($sFile, $bHasThumbnail = false) {
		$aPath = explode("/", $sFile);
		$sFile = $aPath[sizeof($aPath)-1];
		
		if(file_exists($this->sAbsolutePath . $sFile)){
			unlink($this->sAbsolutePath . $sFile);
		}
		
		if ($bHasThumbnail && file_exists($this->sAbsoluteThumbPath . $sFile)) {
			unlink($this->sAbsoluteThumbPath . $sFile);
		}
	}
		
	function _uploadFile() {
		$this->iExtensionPos = strripos($this->sFileUploaded, ".");
		$this->sExtension = substr($this->sFileUploaded, $this->iExtensionPos, (strlen($this->sFileUploaded) - $this->iExtensionPos));
		$this->sFileName = substr($this->sFileUploaded, 0, $this->iExtensionPos);
		$invalidCharacters = array("\\", "/", ":", "*", "?", "\"", "<", ">", "|", "'", "@", " ");
		$this->sNewFileName = str_replace($invalidCharacters, "_", $this->sFileName) . "_" . time() . $this->sExtension;
		
		if (!file_exists($this->sAbsolutePath)) mkdir($this->sAbsolutePath);
		$this->sTargetFile =  $this->sAbsolutePath . $this->sNewFileName;
		if (move_uploaded_file($this->sTempFile, $this->sTargetFile)) {
			if (isset($this->aSettings["imageMaxWidth"]) ||	isset($this->aSettings["imageMaxHeight"])) {
				$this->_resizeImage($this->sTargetFile, $this->aSettings["imageMaxWidth"], $this->aSettings["imageMaxHeight"]);
			}
		
			if (isset($this->aSettings["thumbMaxWidth"]) ||	isset($this->aSettings["thumbMaxHeight"])) {
				$this->_createThumbnail();
			}
			
			$this->bFileUploaded = true;
		}
	}

	function _resizeImage($pathToFile, $maxWidth, $maxHeight){
		$this->ResizeImage->max_width($maxWidth);
		$this->ResizeImage->max_height($maxHeight);
		$this->ResizeImage->image_path($pathToFile);
		$this->ResizeImage->image_resize();
	}	
	
	function _createThumbnail(){
		if (!file_exists($this->sAbsoluteThumbPath)) mkdir($this->sAbsoluteThumbPath);
		$this->sTargetFileThumb =  $this->sAbsoluteThumbPath . $this->sNewFileName;
		copy($this->sTargetFile, $this->sTargetFileThumb);
		$this->_resizeImage($this->sTargetFileThumb, $this->aSettings["thumbMaxWidth"], $this->aSettings["thumbMaxHeight"]);
	}
	
	function getFileName() {
		return $this->sNewFileName;
	}
	
	function isUploaded() {
		return $this->bFileUploaded;
	}
}
?>