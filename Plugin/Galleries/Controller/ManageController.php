<?php
class ManageController extends GalleriesAppController 
{

	var $uses =  array('Galleries.Gallery', 'CategoriesGallery');
	var $components = array('FileManager');	
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = "admin";
		$this->set("title_for_layout", "Galleries");
        $this->set("sTitle", '<i class="fa fa-picture-o fa-fw"></i> Galleries');
    }

    public function admin_index()
    {
        $this->set("galleries", $this->Gallery->find('all'));
        $this->set("path", "/" . $this->plugin . "/img/thumb/");
    }
    
    public function admin_detail($id = "")
    {
        if (!empty($id)) {
            $this->set("sTitle", '<i class="fa fa-picture-o fa-fw"></i> Edit Gallery');
            $this->set("galleryDetails", $this->Gallery->findById($id));
            $this->set("path", "/" . $this->plugin . "/img/thumb/");
        } else {
            $this->set("sTitle", '<i class="fa fa-picture-o fa-fw"></i> Add Gallery');
        }
        $this->set("categoriesGallery", $this->CategoriesGallery->find('all'));
    }
	
	public function admin_save()
	{
		if($this->request->is('post')){ 
			$postData = $this->request['data'];
			$this->Gallery->create();
			if (isset($postData["Gallery"]['id'])) {
				$this->Gallery->id = $postData["Gallery"]['id'];
			}
			
			if (isset($postData["Gallery"]["file_name"]) && $postData["Gallery"]["file_name"]["name"]) {
				$this->FileManager->create(array("path" => "/Plugin/" . $this->plugin . "/webroot/img/"));
				
				if (isset($postData["Gallery"]['id'])) {
					$aGallery = $this->Gallery->findById($postData["Gallery"]['id']);
					if ($aGallery["Gallery"]["file_name"] != "") {
						$this->FileManager->delete($aGallery["Gallery"]["file_name"], true);
					}
				}
				
				$this->FileManager->save($postData["Gallery"]["file_name"], array("imageMaxWidth" => 600, "imageMaxHeight" => 600, "thumbMaxWidth" => 120, "thumbMaxHeight" => 120));
				$this->Gallery->set('file_name', ($this->FileManager->isUploaded()) ? $this->FileManager->getFileName() : "");			
			}
			$this->Gallery->set('description',$postData["Gallery"]['description']);
			$this->Gallery->set('category_id',$postData["Gallery"]['category_id']);
			if ($this->Gallery->save()) {
				$this->addSuccessMessage("Gallery saved successfully");
			} else {
				$this->addDangerMessage("Gallery was not saved!");
			}
			$this->redirect('index');
		} else {
			$this->addDangerMessage("An error occured when saving!");
			$this->redirect('index');
		}
	}
	
	public function admin_delete($id)
	{ 
		if (!is_numeric($id)) {
			throw new Exception("id must be numeric");
		}
		$this->FileManager->create(array("path" => "/Plugin/" . $this->plugin . "/webroot/img/"));
		
		$aGallery = $this->Gallery->findById($id);
		if ($aGallery["Gallery"]["file_name"] != "") {
			$this->FileManager->delete($aGallery["Gallery"]["file_name"], true);
		}
		
		if ($this->Gallery->delete($id)) {
			$this->addSuccessMessage("Gallery deleted successfully");
		} else {
			$this->addDangerMessage("Gallery was not deleted!");
		}			
		$this->redirect('index');	
	}

	public function admin_delete_multiple($ids)
    {
        $flag_error = false;
        $ids = json_decode(str_replace('\\', '', $ids));
        $this->FileManager->create(array("path" => "/Plugin/" . $this->plugin . "/webroot/img/"));
        foreach ($ids as $id) {
        	$aGallery = $this->Gallery->findById($id);
			if ($aGallery["Gallery"]["file_name"] != "") {
				$this->FileManager->delete($aGallery["Gallery"]["file_name"], true);
			}
            if (!$this->Gallery->delete($id)) {
                $flag_error = true;
            }
        }
        if ($flag_error) {
            $this->addDangerMessage("An error occured when deleting galleries");
        } else {
            $this->addSuccessMessage("Galleries has been deleted successfully");
        }
        $this->redirect('index');
    }
}
