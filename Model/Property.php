<?php
class Property extends AppModel 
{
	public $name = 'Property';

	const ADVERT_TYPE = "advert_type_id";
    const PRICE = "price";
    const LOCATION = "local_council_id";
    const PROPERTY_TYPE = "property_type_id";
    const PROPERTY_CATEGORY = "property_category_id";
    const PROPERTY_FINISHING_STATE = "property_finishing_state_id";

	var $actsAs = array(
		'Translate' => array(
			'title' => 'titleTranslation',
            'description' => 'descriptionTranslation'
        )
    );
	public $hasMany = array(
		"Properties.PropertyImage"
	);
	public $hasOne = array(
		'DefaultImage' => array(
			'className' => 'Properties.PropertyImage',
			'conditions' => array('is_default' => 1)
		)
	);	
	public $belongsTo = array(
		"PropertyCategory" => array(
			'className'    => 'Properties.PropertyCategory',
			'foreignKey'   => 'property_category_id'
		),
		"PropertyType" => array(
			'className'    => 'Properties.PropertyType',
			'foreignKey'   => 'property_type_id'
		),
		"AdvertType" => array(
			'className'    => 'Properties.AdvertType',
			'foreignKey'   => 'advert_type_id'
		),
		"Client" => array(
			'className'    => 'Properties.Client',
			'foreignKey'   => 'client_id'
		),
		"LocalCouncil" => array(
			'className'    => 'Properties.LocalCouncil',
			'foreignKey'   => 'local_council_id'
		),
		"PropertyFinishingState" => array(
			'className'    => 'Properties.PropertyFinishingState',
			'foreignKey'   => 'property_finishing_state_id'
		)
	);
	
	public function beforeSave($options = array())
	{
		if (isset($this->data["Property"]["description"])) {			
			$this->data["Property"]["description"] = $this->data["Property"]["description"];
		}
		
		if (isset($this->data["Property"]["address"])) {			
			$this->data["Property"]["address"] = nl2br($this->data["Property"]["address"]);
		}

		if (!empty($this->data["Property"]["price"])) {
			$this->data["Property"]["price"] = str_replace(array(","), "", $this->data["Property"]["price"]);
		}
        
        if (!empty($this->data["Property"]["advert_type_id"]) && $this->data["Property"]["advert_type_id"] == 1) {
            if (!empty($this->data["Property"]["price"]) && ((int)$this->data["Property"]["price"]) < 1000) {
                $this->data["Property"]["price"] = ((int)$this->data["Property"]["price"]) * 1000;
            }
        }
		parent::beforeSave($options);
	}

	public function GetLatest($limit = 4)
	{
		$latestProperties = $this->find('all', array(
            'conditions' => array("Property.is_published" => AppModel::REC_STATUS_ACTIVE),
            'order' => array('Property.created' => 'desc'),
            'limit' => $limit
        ));
        return $latestProperties;
	}
}
