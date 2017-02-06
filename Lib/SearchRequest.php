<?php
App::uses('AdvertType', 'Model');
App::uses('LocalCouncil', 'Model');
App::uses('Property', 'Model');
App::uses('PropertyType', 'Model');
App::uses('PropertyCategory', 'Model');
App::uses('PropertyFinishingState', 'Model');

class SearchRequest
{
    const ADVERT_TYPE = "advert-type";
    const MIN_PRICE = "min-price";
    const MAX_PRICE = "max-price";
    const LOCATIONS = "locations";
    const PROPERTY_TYPE = "property-types";
    const PROPERTY_CATEGORY = "property-category";
    const PROPERTY_FINISHING_STATE = "property-finishing-state";
    const BEDROOMS = "bedrooms";
    const SORT_BY = "sort-by";
    const START = "start";

    protected $advertType = null;
    protected $minPrice = null;
    protected $maxPrice = null;
    protected $locations = null;
    protected $propertyType = null;
    protected $propertyCategory = null;
    protected $propertyFinishingState = null;
    protected $bedrooms = null;
    protected $sortBy = null;
    protected $start = 1;


    protected $isEmpty = true;

    public function toString($excludePage = false)
    {
        $output = "";
        if ($this->getAdvertType()) {
            $output .= (!empty($output)?"/":"") . self::ADVERT_TYPE . ":" . $this->getAdvertTypeFriendlyName();
        }
        if ($this->getPropertyCategory()) {
            $output .= (!empty($output)?"/":"") . self::PROPERTY_CATEGORY . ":" . $this->getPropertyCategoryFriendlyName();
        }
        if ($this->getPropertyType()) {
            $output .= (!empty($output)?"/":"") . self::PROPERTY_TYPE . ":" . $this->getPropertyTypeFriendlyName();
        }
        if ($this->getLocations()) {
            $output .= (!empty($output)?"/":"") . self::LOCATIONS . ":" . $this->getLocationsName();
        }
        if ($this->getPropertyFinishingState()) {
            $output .= (!empty($output)?"/":"") . self::PROPERTY_FINISHING_STATE . ":" . $this->getPropertyFinishingStateFriendlyName();
        }
        if ($this->getMinPrice()) {
            $output .= (!empty($output)?"/":"") . self::MIN_PRICE . ":" . $this->getMinPrice();
        }
        if ($this->getMaxPrice()) {
            $output .= (!empty($output)?"/":"") . self::MAX_PRICE . ":" . $this->getMaxPrice();
        }
        if ($this->getBedrooms()) {
            $output .= (!empty($output)?"/":"") . self::BEDROOMS . ":" . $this->getBedrooms();
        }
        if ($this->getSortBy()) {
            $output .= (!empty($output)?"/":"") . self::SORT_BY . ":" . $this->getSortBy();
        }
        if (!$excludePage) {
            if ($this->getStart() && $this->getStart() > 1) {
                $output .= (!empty($output)?"/":"") . self::START . ":" . $this->getStart();
            }
        }
        return $output;
    }

    public function toArray()
    {
        $outputArr = array();
        if ($this->getAdvertType()) {
            $outputArr["AdvertTypes"] = $this->getAdvertType();
        }
        if ($this->getPropertyCategory()) {
            $outputArr["PropertyCategories"] = $this->getPropertyCategory();
        }
        if ($this->getPropertyType()) {
            $outputArr["PropertyTypes"] = $this->getPropertyType();
        }
        if ($this->getLocations()) {
            $outputArr["Locations"] = $this->getLocations();
        }
        if ($this->getPropertyFinishingState()) {
            $outputArr["PropertyFinishingStates"] = $this->getPropertyFinishingState();
        }
        if ($this->getMinPrice()) {
            $outputArr["MinPrice"] = $this->getMinPrice();
        }
        if ($this->getMaxPrice()) {
            $outputArr["MaxPrice"] = $this->getMaxPrice();
        }
        if ($this->getBedrooms()) {
            $outputArr["Bedrooms"] = $this->getBedrooms();
        }
        return $outputArr;
    }

    public function getFindConditions($entity = "Property")
    {
        $conditions = array();
        if ($this->getAdvertType()) {
            $advertType = $this->getAdvertType();
            $conditions[$entity . "." . AppModel::ADVERT_TYPE] = $advertType["AdvertType"]["id"];
        }
        if ($this->getMinPrice() || $this->getMaxPrice()) {
            if (!$this->getMaxPrice()) {
                $conditions[$entity . "." . AppModel::PRICE . " >="] = $this->getMinPrice();
            } elseif (!$this->getMinPrice()) {
                $conditions[$entity . "." . AppModel::PRICE . " <="] = $this->getMaxPrice();
            } else {
                $conditions[] = $entity . "." . AppModel::PRICE .
                " BETWEEN " . $this->getMinPrice() . " AND " . $this->getMaxPrice();
            }
        }
        if ($this->getLocations()) {
            $locationIds = array();
            foreach ($this->getLocations() as $location) {
                $locationIds[] = $location["LocalCouncil"]["id"];
            }
            $conditions[$entity . "." . AppModel::LOCATION] = $locationIds;
        }
        if ($this->getPropertyCategory()) {
            $propertyCategory = $this->getPropertyCategory();
            $conditions[$entity . "." . AppModel::PROPERTY_CATEGORY] = $propertyCategory["PropertyCategory"]["id"];
        }
        if ($this->getPropertyType()) {
            $propertyTypeIds = array();
            foreach ($this->getPropertyType() as $propertyType) {
                $propertyTypeIds[] = $propertyType["PropertyType"]["id"];
            }
            $conditions[$entity . "." . AppModel::PROPERTY_TYPE] = $propertyTypeIds;
        }
        if ($this->getBedrooms()) {
            if (strpos($this->getBedrooms(), '+') !== false) {
                $conditions[$entity . "." . "bedrooms >="] = (int)$this->getBedrooms();
            } else {
                $conditions[$entity . "." . "bedrooms"] = $this->getBedrooms();
            }
        }
        if ($this->getPropertyFinishingState()) {
            $propertyFinishingStateIds = array();
            foreach ($this->getPropertyFinishingState() as $propertyFinishingState) {
                if (isset($propertyFinishingState["PropertyFinishingState"])) {
                    $propertyFinishingState = $propertyFinishingState["PropertyFinishingState"];
                }
                $propertyFinishingStateIds[] = $propertyFinishingState["id"];
            }
            $conditions[$entity . "." . AppModel::PROPERTY_FINISHING_STATE] = $propertyFinishingStateIds;
        }
        return $conditions;
    }

    public function getSortOptions($entity = "Property")
    {
        $order = array();
        $sortBy = $this->getSortBy();
        if (empty($sortBy) || $sortBy == "date") {
            $order[] = $entity . ".id DESC";
        } elseif ($sortBy == "price-desc") {
            $order[] = $entity . ".price DESC";
        } elseif ($sortBy == "price-asc") {
            $order[] = $entity . ".price ASC";
        }
        return $order;
    }

    public function hydrate($postData)
    {
        $emptyCheckData = $postData;
        unset($emptyCheckData["start"]);
        $this->isEmpty = empty($emptyCheckData);

        if (!empty($postData[self::ADVERT_TYPE])) {
            $this->setAdvertType($postData[self::ADVERT_TYPE]);
        }

        if (!empty($postData[self::MIN_PRICE])) {
            $this->setMinPrice($postData[self::MIN_PRICE]);
        }

        if (!empty($postData[self::MAX_PRICE])) {
            $this->setMaxPrice($postData[self::MAX_PRICE]);
        }

        if (!empty($postData[self::LOCATIONS])) {
            $this->setLocations($postData[self::LOCATIONS]);
        }

        if (!empty($postData[self::PROPERTY_CATEGORY])) {
            $this->setPropertyCategory($postData[self::PROPERTY_CATEGORY]);
        }

        if (!empty($postData[self::PROPERTY_TYPE])) {
            $this->setPropertyType($postData[self::PROPERTY_TYPE]);
        }

        if (!empty($postData[self::BEDROOMS])) {
            $this->setBedrooms($postData[self::BEDROOMS]);
        }

        if (!empty($postData[self::SORT_BY])) {
            $this->setSortBy($postData[self::SORT_BY]);
        }

        if (!empty($postData[self::START])) {
            $this->setStart($postData[self::START]);
        }
    }

    public function getAdvertType()
    {
        return $this->advertType;
    }

    public function getAdvertTypeFriendlyName()
    {
        if ($this->getAdvertType()) {
            $advertType = $this->getAdvertType();
            return Util::getSlug($advertType["AdvertType"]["name"]);
        }
        return null;
    }

    public function setAdvertType($advertType)
    {
        if ((int)($advertType) > 0) {
            if (isset($advertType[0]["AdvertType"]) && is_array($advertType[0]["AdvertType"])) {
                $this->advertType = $advertType[0];
            } else {
                //get advert type by name;
                $entity = new AdvertType();
                $this->advertType = $entity->find(
                    "first",
                    array(
                        "conditions" => array("AdvertType.id" => $advertType)
                    )
                );
            }
        } else {
            $advertType = ucwords(str_replace("_", "/", str_replace("-", " ", $advertType)));
            $entity = new AdvertType();
            $this->advertType = $entity->find(
                "first",
                array(
                    "conditions" => array("AdvertType.name" => $advertType)
                )
            );
        }
        return $this;
    }

    public function getLocations()
    {
        return $this->locations;
    }

    public function getLocationsName()
    {
        if ($this->getLocations()) {
            $names = array();
            foreach ($this->getLocations() as $location) {
                if (!empty($location["LocalCouncil"]["nome"])) {
                    $names[] = $location["LocalCouncil"]["nome"];
                } else {
                    $names[] = $location["LocalCouncil"]["id"];
                }
            }
            return implode(".", $names);
        }
        return null;
    }

    public function setLocations($locations)
    {
        if ((int)($locations[0]) > 0) {
            if (isset($locations[0]["LocalCouncil"]) && is_array($locations[0]["LocalCouncil"])) {
                $this->locations = $locations;
            } else {
                $entity = new LocalCouncil();
                $this->locations = $entity->find(
                    "all",
                    array(
                        "conditions" => array("LocalCouncil.id" => $locations)
                    )
                );
            }
        } else {
            $locations = explode('.', $locations);
            $entity = new LocalCouncil();
            $this->locations = $entity->find(
                "all",
                array(
                    "conditions" => array("LocalCouncil.nome" => $locations)
                )
            );
        }
        return $this;
    }

    public function getPropertyDetails()
    {
        return $this->propertyDetails;
    }

    public function getPropertyDetailIds()
    {
        $propertyDetailIds = array();
        foreach ($this->getPropertyDetails() as $propertyDetail) {
            $propertyDetailIds[] = $propertyDetail["PropertyDetail"]["id"];
        }
        return $propertyDetailIds;
    }

    public function getPropertyFinishingState()
    {
        return $this->propertyFinishingState;
    }

    public function getPropertyFinishingStateFriendlyName()
    {
        $propertyFinishingState = $this->getPropertyFinishingState();
        return Util::getSlug($propertyFinishingState["PropertyFinishingState"]["name"]);
    }

    public function setPropertyFinishingState($propertyFinishingState)
    {
        if ((int)($propertyFinishingState) > 0) {
            $entity = new PropertyFinishingState();
            $this->propertyFinishingState = $entity->find(
                "first",
                array(
                    "conditions" => array("PropertyFinishingState.id" => $propertyFinishingState)
                )
            );
        } else {
            $propertyFinishingState = explode('.', $propertyFinishingState);
            $entity = new PropertyFinishingState();
            $this->propertyFinishingState = $entity->find(
                "first",
                array(
                    "conditions" => array("PropertyFinishingState.name" => $propertyFinishingState)
                )
            );
        }
        return $this;
    }

    public function getMinPrice()
    {
        return $this->minPrice;
    }

    public function setMinPrice($minPrice)
    {
        $this->minPrice = $minPrice;
        return $this;
    }

    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    public function getBedrooms()
    {
        return $this->bedrooms;
    }

    public function setBedrooms($bedrooms)
    {
        $this->bedrooms = $bedrooms;
        return $this;
    }

    public function getPropertyType()
    {
        return $this->propertyType;
    }

    public function getPropertyTypeFriendlyName()
    {
        if ($this->getPropertyType()) {
            $friendlyNames = array();
            foreach ($this->getPropertyType() as $propertyType) {
                if (!empty($propertyType["PropertyType"]["name"])) {
                    $friendlyNames[] = $propertyType["PropertyType"]["name"];
                } else {
                    $friendlyNames[] = $propertyType["PropertyType"]["id"];
                }
            }
            return implode(".", $friendlyNames);
        }
        return null;
    }

    public function setPropertyType($propertyType)
    {
        if ((int)($propertyType[0]) > 0) {
            if (isset($propertyType[0]["PropertyType"]) && is_array($propertyType[0]["PropertyType"])) {
                $this->propertyType = $propertyType;
            } else {
                $entity = new PropertyType();
                $this->propertyType = $entity->find(
                    "all",
                    array(
                        "conditions" => array("PropertyType.id" => $propertyType)
                    )
                );
            }
        } else {
            $propertyTypes = explode('.', $propertyType);
            foreach ($propertyTypes as $key => $value) {
                $propertyTypes[$key] = ucwords(str_replace("_", "/", str_replace("-", " ", $value)));
            }

            $searchConditions = array("PropertyType.name" => $propertyTypes);
            if ($this->getPropertyCategory()) {
                $category = $this->getPropertyCategory();
                $searchConditions["PropertyType.property_category_id"] = $category["PropertyCategory"]["id"];
            }
            $entity = new PropertyType();
            
            $this->propertyType = $entity->find(
                "all",
                array(
                    "conditions" => $searchConditions
                )
            );
        }
        return $this;
    }

    public function getPropertyCategory()
    {
        return $this->propertyCategory;
    }

    public function getPropertyCategoryFriendlyName()
    {
        $propertyCategory = $this->getPropertyCategory();
        return Util::getSlug($propertyCategory["PropertyCategory"]["name"]);
    }

    public function setPropertyCategory($propertyCategory)
    {
        if ((int)($propertyCategory) > 0) {
            $entity = new PropertyCategory();
            $this->propertyCategory = $entity->find(
                "first",
                array(
                    "conditions" => array("PropertyCategory.id" => $propertyCategory)
                )
            );
        } else {
            $entity = new PropertyCategory();
            $propertyCategory = ucwords(str_replace("_", "/", str_replace("-", " ", $propertyCategory)));
            $this->propertyCategory = $entity->find(
                "first",
                array(
                    "conditions" => array("PropertyCategory.name" => $propertyCategory)
                )
            );
        }
        return $this;
    }

    public function getSortBy()
    {
        return $this->sortBy;
    }

    public function setSortBy($sortBy)
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setStart($start)
    {
        $this->start = $start;
        return $this;
    }

    public function isSearching()
    {
        return !$this->isEmpty;
    }

    public function paramEncode($s)
    {
        $replace = array("/", "?", "&");
        $with = array("_ds_", "_q_", "_a_");
        return str_replace($replace, $with, $s);
    }

    public function paramDecode($s)
    {
        $replace = array("/", "?", "&");
        $with = array("_ds_", "_q_", "_a_");
        return str_replace($with, $replace, $s);
    }
}
