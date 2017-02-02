<?php
class ManageController extends SettingsAppController
{   
    
    var $uses = array("Settings");

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->layout = "admin";
        $this->set("title_for_layout", "Settings Page");
    }

    function admin_index()
    {
        $this->set("sTitle", '<i class="fa fa-sliders fa-fw fa-rotate-90"></i> Settings Page');
        $settings = $this->Settings->find('all');
        if (!empty($settings)) {
            $this->set("settings",$settings);
        }
    }
    
    function admin_save()
    {
        $is_saved = true;
        if (isset($this->request['data']['Settings']['default_editor']) && $this->request['data']['Settings']['default_editor'] == "on") {
            $default_editor = 'markup';
        } else {
            $default_editor = 'rich-text';
        }
        //setting Editor
        if (isset($this->request['data']['Settings']['id_default_editor'])) {
            $is_saved = $this->_saveSetting('default_editor', $default_editor, $this->request['data']['Settings']['id_default_editor']);
        } else {
            $is_saved = $this->_saveSetting('default_editor', $default_editor);
        }
        //setting Google analytics
        if (isset($this->request['data']['Settings']['id_google_analytics'])) {
            $is_saved = $this->_saveSetting('google_analytics', $this->request['data']['Settings']['google_analytics'], $this->request['data']['Settings']['id_google_analytics']);
        } else {
            $is_saved = $this->_saveSetting('google_analytics', $this->request['data']['Settings']['google_analytics']);
        }
        // check if is saved
        if ($is_saved) {
            $this->addSuccessMessage("Settings updated successfully");
        } else {
            $this->addDangerMessage("An error occured when saving record");
        }
        $this->redirect('index');
    }  

    protected function _saveSetting($name, $value, $id = NULL)
    {
        $this->Settings->create();
        if (isset($id)) {
            $this->Settings->read(null, $id);
        }
        $this->Settings->set(array('setting_name' => $name, 'setting_value' => $value));
        if ($this->Settings->save()) {
            return true;
        } else {
            return false;
        }
    }
}
?>