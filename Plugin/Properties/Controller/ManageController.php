<?php
class ManageController extends PropertiesAppController {

	var $uses = array(
        'Properties.Property',
        'Properties.Client',
        'Properties.AdvertType',
        'Properties.PropertyType',
        'Properties.PropertyCategory',
        'Properties.PropertyImage'
    );
	var $components = array('FileManager');    

	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = "admin";
	}

	public function admin_index()
	{	
		$this->set("title_for_layout", "Proprietà");
        $this->set("sTitle", '<i class="fa fa-home fa-fw"></i> Proprietà');
		$conditions = array(
			'order' => array('Property.id' => 'DESC')
		);		
		$this->set("Properties", $this->Property->find('all', $conditions));
	}
	
	public function admin_detail($id = "")
    {
        if (!empty($id)) {
            $this->set("sTitle", '<i class="fa fa-home fa-fw"></i> Modifica Proprietà');
            $this->set("propertyDetails", $this->Property->findById($id));
        } else {
            $this->set("sTitle", '<i class="fa fa-home fa-fw"></i> Aggiungi Proprietà');
        }
        $this->set("advertTypes", $this->getAdvertTypes());
        $this->set("propertyCategories", $this->getPropertyCategories());
        $this->set("propertyTypes", $this->getPropertyTypes());
        $this->set("locations", $this->getLocations());
    }

    public function admin_save()
    {
        if($this->request->is('post')) {
            $postData = $this->request['data']['Property'];
            $this->Property->create();
            $this->Property->set($postData);
            $this->Property->set('is_published', false);
            $postDataClient = $this->request['data']['Client'];
            $this->Client->create();
            $this->Client->set($postDataClient);
            if (!$this->Client->save()) {
                $this->addDangerMessage("An error occured when saving!");
            }
            $this->Property->set("client_id", $this->Client->id);
            if ($this->Property->saveMany()) {
                if(isset($postData['Property']['id'])) {
                    $this->addSuccessMessage("Property updated successfully");
                } else {
                    $this->addSuccessMessage("Property created successfully");
                }
            } else {
                $this->addDangerMessage("An error occured when saving!");
            }
            $this->redirect('index');
        }
    }

    public function admin_publish($id)
    {
        if ($id != null) {
            $this->Property->create();
            $this->Property->id = $id;
            $this->Property->set('is_published', true);
            //$this->Property->set('published_date', date("Y-m-d H:i:s"));
            if ($this->Property->save()) {
                $this->addSuccessMessage("Property updated successfully");
            } else {
                $this->addDangerMessage("An error occured when saving!");
            }
        }
        $this->redirect('index');
    }

    public function admin_delete($id)
    {
        if ($this->Property->delete($id)) {
            $this->addSuccessMessage("Property has been deleted successfully");
        } else {
            $this->addDangerMessage("An error occured when deleting Property");
        }
        $this->redirect('index');
    }

    public function admin_delete_multiple($ids)
    {
        $flag_error = false;
        $ids = json_decode(str_replace('\\', '', $ids));
        foreach ($ids as $id) {
            if (!$this->Property->delete($id)) {
                $flag_error = true;
            }
        }
        if ($flag_error) {
            $this->addDangerMessage("An error occured when deleting Properties");
        } else {
            $this->addSuccessMessage("Properties has been deleted successfully");
        }
        $this->redirect('index');
    }

    public function admin_markdown_help()
    {
        $this->set("sTitle", '<i class="fa fa-info fa-fw"></i> Markdown Help');
    }

    public function admin_gallery($id = "")
    {
        $this->set("title_for_layout", "Fotografie");
        $this->set("sTitle", '<i class="fa fa-picture-o fa-fw"></i> Fotografie');
        if (!empty($id)) {
            $this->set("galleries", $this->PropertyImage->findAllByPropertyId($id));
            $this->set("path", "/" . $this->plugin . "/img/thumb/");
            $this->set("propertyId", $id);
        }
    }
	
	public function admin_gallery_detail($property_id)
    {
        if (isset($this->request->query['id'])) { 
            $id = $this->request->query['id'];
        }
        if (!empty($id)) {
            $this->set("sTitle", '<i class="fa fa-picture-o fa-fw"></i> Modifica Foto');
            $this->set("propertyImages", $this->PropertyImage->findById($id));
            $this->set("path", "/" . $this->plugin . "/img/thumb/");
        } else {
            $this->set("sTitle", '<i class="fa fa-picture-o fa-fw"></i> Aggiungi Foto');
        }
        $this->set("propertyId", $property_id);
    }
	
	public function admin_save_gallery()
    {
        if ($this->request->is('post')){ 
            $postData = $this->request['data'];
            $this->PropertyImage->create();
            if (isset($postData["PropertyImage"]['id'])) {
                $this->PropertyImage->id = $postData["PropertyImage"]['id'];
            }
            
            if (isset($postData["PropertyImage"]["file_name"]) && $postData["PropertyImage"]["file_name"]["name"]) {
                $this->FileManager->create(array("path" => "/Plugin/" . $this->plugin . "/webroot/img/"));
                
                if (isset($postData["PropertyImage"]['id'])) {
                    $aGallery = $this->PropertyImage->findById($postData["PropertyImage"]['id']);
                    if ($aGallery["PropertyImage"]["file_name"] != "") {
                        $this->FileManager->delete($aGallery["PropertyImage"]["file_name"], true);
                    }
                }
                
                $this->FileManager->save($postData["PropertyImage"]["file_name"], array("imageMaxWidth" => 640, "imageMaxHeight" => 425, "thumbMaxWidth" => 100, "thumbMaxHeight" => 65));
                $this->PropertyImage->set('file_name', ($this->FileManager->isUploaded()) ? $this->FileManager->getFileName() : "");          
            }
            $this->PropertyImage->set('description',$postData["PropertyImage"]['description']);
            $this->PropertyImage->set('property_id',$postData["PropertyImage"]['property_id']);
            if ($this->PropertyImage->save()) {
                $this->addSuccessMessage("Gallery saved successfully");
            } else {
                $this->addDangerMessage("Gallery was not saved!");
            }
            $this->redirect('gallery/'.$postData["PropertyImage"]['property_id']);
        } else {
            $this->addDangerMessage("An error occured when saving!");
            $this->redirect('index');
        }
    }

    public function admin_delete_gallery($id)
    {
        if ($this->PropertyImage->delete($id)) {
            $this->addSuccessMessage("Gallery has been deleted successfully");
        } else {
            $this->addDangerMessage("An error occured when deleting Gallery");
        }
        $this->redirect('index');
    }

    public function admin_delete_multiple_gallery($ids)
    {
        $flag_error = false;
        $ids = json_decode(str_replace('\\', '', $ids));
        foreach ($ids as $id) {
            if (!$this->PropertyImage->delete($id)) {
                $flag_error = true;
            }
        }
        if ($flag_error) {
            $this->addDangerMessage("An error occured when deleting Galleries");
        } else {
            $this->addSuccessMessage("Galleries has been deleted successfully");
        }
        $this->redirect('index');
    }
	
    public function admin_is_default($property_id)
    {
        if (!empty($property_id) && isset($this->request->query['id'])) {
            // update the others
            $this->PropertyImage->updateAll(
                array('PropertyImage.is_default' => false),
                array('PropertyImage.property_id' => $property_id)
            );
            $this->PropertyImage->create();
            $this->PropertyImage->id = (int)$this->request->query['id'];
            $this->PropertyImage->set('is_default', true);
            $this->PropertyImage->save();
        }           
        $this->redirect('index');   
    }   
}
?>