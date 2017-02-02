<?php
ini_set("upload_max_filesize","10M");
ini_set("memory_limit","1024M");
class ResizeImageComponent extends Component {
	private $max_width;
	private $max_height;
	private $path;
	private $img;
	private $new_width;
	private $new_height;
	private $mime;
	private $image;
	private $image_resized;
	private $width;
	private $height;
	
	function max_width($width)
	{
		$this->max_width = $width;
	}
	
	function max_height($height)
	{
		$this->max_height = $height;
	}
	
	function image_path($path)
	{
		$this->path = $path;
	}
	
	function get_mime()
	{
		$img_data = getimagesize($this->path);
		$this->mime = $img_data['mime'];
	}
	
	function create_image()
	{
		switch($this->mime)
		{
			case 'image/jpeg':
				$this->image = imagecreatefromjpeg($this->path);
			break;
			
			case 'image/gif':
				$this->image = imagecreatefromgif($this->path);
			break;
			
			case 'image/png':
				$this->image = imagecreatefrompng($this->path);
			break;
		}
	}
		
	function image_resize()
	{
		$this->get_mime();
		if (!empty($this->mime)) {
			$this->create_image();
			$this->width = imagesx($this->image);
			$this->height = imagesy($this->image);
			$this->set_dimension();
			$this->image_resized = imagecreatetruecolor($this->new_width,$this->new_height);
			$this->checkTransperancy();
			imagecopyresampled($this->image_resized, $this->image, 0, 0, 0, 0, $this->new_width, $this->new_height,$this->width, $this->height);
			$this->save_image();
		}
	}
	
	function checkTransperancy()
	{
		if ($this->mime == 'image/png') {   
			// Turn off transparency blending (temporarily)
			imagealphablending($this->image_resized, false);	   
			// Create a new transparent color for image
			$color = imagecolorallocatealpha($this->image_resized, 0, 0, 0, 127);	   
			// Completely fill the background of the new image with allocated color.
			imagefill($this->image_resized, 0, 0, $color);	   
			// Restore transparency blending
			imagesavealpha($this->image_resized, true);
      	}
	}
		
	function save_image()
	{
		switch($this->mime)
		{
			case 'image/jpeg':
				imagejpeg($this->image_resized,$this->path,100);
			break;
			
			case 'image/gif':
				imagegif($this->image_resized,$this->path);
			break;
			
			case 'image/png':
				imagepng($this->image_resized,$this->path);
			break;
		}
	}
	
		
	//######### FUNCTION FOR RESETTING DEMENSIONS OF IMAGE ###########
	function set_dimension()
	{
		
		$scale = min($this->max_width/$this->width, $this->max_height/$this->height);
	
		# If the image is larger than the max shrink it
		if ($scale < 1) {
			$this->new_width = floor($scale*$this->width);
			$this->new_height = floor($scale*$this->height);
		}
		else{
			$this->new_width = $this->width;
			$this->new_height = $this->height;
		}				
	}
}
?>