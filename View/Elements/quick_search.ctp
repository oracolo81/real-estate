<div id="header" class="heading" style="background-image: url(<?=$this->Html->url('/img/img01.jpg');?>);">
    <div class="container">
        <form id="searchForm" action="/properties/search" method="post" role="form">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="quick-search">
                        <div class="row">
                            <form role="form">
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label class="radio-inline">
                                                <input type="radio" name="<?=SearchRequest::ADVERT_TYPE?>"<?=($searchRequest->getAdvertTypeFriendlyName() == "for-sale")?" checked=\"checked\"":"" ?> value="for-sale"><?php echo __("Buy");?>
                                            </label><br>
                                            <label class="radio-inline">
                                                <input type="radio" name="<?=SearchRequest::ADVERT_TYPE?>"<?=($searchRequest->getAdvertTypeFriendlyName() == "to-let")?" checked=\"checked\"":"" ?> value="to-let"><?php echo __("To Let");?>
                                            </label>
                                        </div>
                                        <div class="col-xs-6">
                                            <label class="radio-inline">
                                                <input type="radio" onchange="onPropertyCategorySelect(this);" name="<?=SearchRequest::PROPERTY_CATEGORY?>" data-category-id="1" <?=($searchRequest->getPropertyCategoryFriendlyName() == "residential" || !$searchRequest->isSearching())?" checked=\"checked\"":"" ?> value="residential"> <?=__("Residential")?>
                                            </label><br>
                                            <label class="radio-inline">
                                                <input type="radio" onchange="onPropertyCategorySelect(this);" name="<?=SearchRequest::PROPERTY_CATEGORY?>" data-category-id="2" <?=($searchRequest->getPropertyCategoryFriendlyName() == "commercial")?" checked=\"checked\"":"" ?> value="commercial"> <?=__("Commercial")?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <select class="form-control" id="search-property-type" name="<?=SearchRequest::PROPERTY_TYPE?>">
                                                    <option value=""><?php echo __("Type");?></option>
                                                    <?php if (!empty($propertyTypes)) {
                                                        foreach ($propertyTypes as $propertyType) {
                                                            $selected = false;
                                                            $searchRequestPropertyType = $searchRequest->getPropertyType();
                                                            if ($searchRequestPropertyType[0]["PropertyType"]["id"] == $propertyType["PropertyType"]["id"]) {
                                                                $selected = true;
                                                            }
                                                        ?>
                                                        <option data-property-category-id="<?=$propertyType["PropertyType"]["property_category_id"]?>" value="<?=$propertyType["PropertyType"]["id"]?>"<?=($selected)?" selected='selected'":""?>><?=$propertyType["PropertyType"]["name"]?></option>
                                                        <?php
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <select class="form-control" name="<?=SearchRequest::LOCATIONS?>">
                                            <option><?php echo __("Location");?></option>
                                            <?php
                                            if (!empty($locations)) {
                                                foreach ($locations as $location) {
                                                ?>
                                                <option value="<?=$location["LocalCouncil"]["id"]?>"><?=$location["LocalCouncil"]["nome"]?></option>
                                                <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="<?=SearchRequest::BEDROOMS?>" id="search-bedrooms">
                                            <option value=""><?php echo __("N. Bedrooms");?></option>
                                            <option value="1"<?=(($searchRequest->getBedrooms() && $searchRequest->getBedrooms() == 1)?" selected=\"selected\"":"")?>>1</option>
                                            <option value="2"<?=(($searchRequest->getBedrooms() && $searchRequest->getBedrooms() == 2)?" selected=\"selected\"":"")?>>2</option>
                                            <option value="3"<?=(($searchRequest->getBedrooms() && $searchRequest->getBedrooms() == 3)?" selected=\"selected\"":"")?>>3</option>
                                            <option value="4+"<?=(($searchRequest->getBedrooms() && $searchRequest->getBedrooms() == "4+")?" selected=\"selected\"":"")?>>4+</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="<?=SearchRequest::MIN_PRICE?>" placeholder='<?php echo __("Min Price");?>'>
                                    </div>
                                    <div class="form-group"> 
                                        <input class="form-control" type="text" name="<?=SearchRequest::MAX_PRICE?>" placeholder='<?php echo __("Max Price");?>'>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <select class="form-control" name="<?=SearchRequest::SORT_BY?>">
                                            <option value=""><?=__("Latest first")?></option>
                                            <option value="price-asc"<?=(($searchRequest->getSortBy() && $searchRequest->getSortBy() == "price-asc")?" selected=\"selected\"":"")?>><?=__("Cheapest first")?></option>
                                            <option value="price-desc"<?=(($searchRequest->getSortBy() && $searchRequest->getSortBy() == "price-desc")?" selected=\"selected\"":"")?>><?=__("Expensive first")?></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit" value="Search" class="btn btn-warning btn-block">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a></li> 
                        <li class="active">Properties</li>
                    </ol>
                </div>
            </div>
        </form>
    </div>
</div>