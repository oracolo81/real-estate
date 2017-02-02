<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * @package AppController
 * @link    http://cakephp.org CakePHP(tm) Project
 * @since   CakePHP(tm) v 0.2.9
 */

App::uses('AppController', 'Controller');
App::uses("SearchRequest", "Lib");

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package App.Controller
 * @link    http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array("Pages.Page", "Properties.Property");

    public $components = array('Pages');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();
        $this->layout = "default";
    }

    /**
     * Displays a view
     *
     * @return void
     * @throws NotFoundException When the view file could not be found
     *   or MissingViewException in debug mode.
     */
    public function display($name)
    {
        $currentPage = $this->Page->findByCustomLink($name);
        $this->Pages->setPageData($this, $currentPage['Page']['name']);
    }

    public function home()
    {
        $searchRequest = new SearchRequest();
        if (!empty($this->params["named"])) {
            $searchRequest->hydrate($this->params["named"]);
        }
        $this->set("searchRequest", $searchRequest);
        $this->set("locations", $this->getLocations());
        $this->set("propertyTypes", $this->getPropertyTypes());

        $this->Property->locale = $this->Session->read('Config.language');
        $aProperties = $this->Property->GetLatest(20);
        $this->set("aProperties", $aProperties);

        $latestProperties = $this->Property->GetLatest();
        $this->set("latestProperties", $latestProperties);

        $page = $this->Page->findByName('Home');
        $this->set("page", $page['Page']); 
    }
}
