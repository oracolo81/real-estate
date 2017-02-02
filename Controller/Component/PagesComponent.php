<?php

class PagesComponent extends Component
{
    public function setPageData($oController, $sName)
    {
        $params = array("conditions" => array("Page.name" => $sName));
        $result = $oController->Page->find("first", $params);
        if (!empty($result)) {
            $page = $result["Page"];
            $oController->set("page", $page);
            $oController->set("title_for_layout", $page["browser_title"]);
        }
        return $result;
    }
}
