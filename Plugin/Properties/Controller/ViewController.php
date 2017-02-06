<?php
App::uses("SearchRequest", "Lib");

class ViewController extends PropertiesAppController
{
    const ITEMS_PER_PAGE = 9;

	var $uses = array(
        "Pages.Page",
        'Properties.Property',
        'Properties.AdvertType',
        'Properties.PropertyType',
        'Properties.PropertyCategory',
        'Properties.PropertyImages',
    );
		
    var $components = array(
        'Pages',
        'RequestHandler',
        'Session',
        'Paginator'
    );

	public function beforeFilter() 
    {
		parent::beforeFilter();
		$this->Auth->allow();
	}

    public function beforeRender()
    {
        $page = $this->Page->findByName('Properties');
        if (isset($page)) {
            $this->set("page", $page['Page']);
        }
        $searchRequest = new SearchRequest();

        if (!empty($this->params["named"])) {
            $searchRequest->hydrate($this->params["named"]);
        }
        $this->set("searchRequest", $searchRequest);
        $this->prepareSearchFormData();
    }

	public function index()
    {
        $searchRequest = new SearchRequest();

        if (!empty($this->params["named"])) {
            $searchRequest->hydrate($this->params["named"]);
        }
        $this->set("searchRequest", $searchRequest);
        $this->prepareSearchFormData();

        $findOptions = array(
            "conditions" => $searchRequest->getFindConditions(),
            "order" => $searchRequest->getSortOptions(),
            "limit" => self::ITEMS_PER_PAGE,
            "offset" => ($searchRequest->getStart() - 1),
            "group" => "Property.id"
        );
        $findOptions["conditions"][] = array("Property.is_published" => AppModel::REC_STATUS_ACTIVE);

        $this->Property->locale = $this->Session->read('Config.language');

        $this->paginate = array(
            'Property' => $findOptions
        );
        $properties = $this->paginate('Property');
        $this->set("properties", $properties);

        $findOptions = array(
            "conditions" => $searchRequest->getFindConditions(),
            "group" => "Property.id"
        );
        $findOptions["conditions"][] = array("Property.is_published" => AppModel::REC_STATUS_ACTIVE);
        $count = $this->Property->find(
            "count",
            $findOptions
        );
        $this->set("count", $count);
        $this->set("start", $searchRequest->getStart());
        $this->set("items_per_page", self::ITEMS_PER_PAGE);
    }
		
	public function detail($id = "")
    {
        $searchRequest = new SearchRequest();

        if (!empty($this->params["named"])) {
            $searchRequest->hydrate($this->params["named"]);
        }
        $this->set("searchRequest", $searchRequest);
        
        $this->prepareSearchFormData();
        if (!empty($id)) {
            $aProperty = $this->loadPropertyById($id);
            $this->set("propertyDetails", $aProperty);
        } else {
            $this->redirect('/properties');
            exit;
        }
    }

    public function search()
    {
        $this->Pages->setPageData($this, "search-results");
        $searchRequest = new SearchRequest();
        $searchRequest->hydrate($_POST);
        $redirectUrl = "/search/" . $searchRequest->toString();
        return $this->redirect($redirectUrl);
    }

    protected function prepareSearchFormData()
    {
        $this->set("propertyCategories", $this->getPropertyCategories());
        $this->set("propertyTypes", $this->getPropertyTypes());
        $this->set("locations", $this->getLocations());
        $this->set("path", "/" . $this->plugin . "/img/thumb/");
    }
			
	private function _formatDate($date){
		$date = explode("/", $date);
		return mktime(0,0,0, $date[1], $date[0], $date[2]);
	}

    protected function loadPropertyById($id)
    {
        $this->Property->locale = $this->Session->read('Config.language');

        $property = $this->Property->find(
            "first",
            array(
                "conditions" => array(
                    "Property.id" => $id,
                    "Property.is_published =" => AppModel::REC_STATUS_ACTIVE
                )
            )
        );
        if (empty($property)) {
            throw new NotFoundException();
        }
        return $property;
    }	
}
?>