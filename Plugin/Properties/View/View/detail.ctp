<?php echo $this->element("quick_search"); ?>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3">
                <div class="row">
                    <div class="col-md-12 single-post">
                        <div class="row">
                            <div class="col-md-12">
                                <h2><?php echo $propertyDetails['Property']['title']; ?></h2>
                                <div id="slider-property" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <?php if (!empty($propertyDetails['PropertyImage'])) {
                                            foreach ($propertyDetails['PropertyImage'] as $key => $image) {
                                                $class = ($image['is_default']) ? "active" : "";
                                                ?>
                                                <li data-target="#slider-property" data-slide-to="<?php echo $key; ?>" class="<?php echo $class; ?>">
                                                    <img src="/properties/img/thumb/<?php echo $image['file_name']; ?>" alt="<?php echo $image['description']; ?>">
                                                </li>
                                                <?php
                                            }
                                        } ?>
                                    </ol>
                                    <div class="carousel-inner">
                                        <?php if (!empty($propertyDetails['PropertyImage'])) {
                                            foreach ($propertyDetails['PropertyImage'] as $key => $image) {
                                                $class = ($image['is_default']) ? "active" : "";
                                                ?>
                                                <div class="item <?php echo $class; ?>"><img src="/properties/img/<?php echo $image['file_name']; ?>" alt="<?php echo $image['description']; ?>"> </div>
                                                <?php
                                            }
                                        } ?>
                                    </div>
                                    <a class="left carousel-control" href="#slider-property" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                    </a>
                                    <a class="right carousel-control" href="#slider-property" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                    </a>
                                </div>
                                <h3><?php echo __("Property Overview");?></h3>
                                <table class="table table-bordered">
                                    <tr><td width="20%"><strong><?php echo __("ID");?></strong></td><td>#<?php echo $propertyDetails['Property']['id']; ?></td></tr>
                                    <?php if (!empty($propertyDetails['Property']['price'])) { ?>
                                        <tr><td><strong><?php echo __("Price");?></strong></td><td>&euro;<?php echo $propertyDetails['Property']['price']; ?></td></tr>
                                    <?php } ?>
                                    <?php if (!empty($propertyDetails['PropertyType']['name'])) { ?>
                                        <tr><td><strong><?php echo __("Type");?></strong></td><td><?php echo $propertyDetails['PropertyType']['name']; ?></td></tr>
                                    <?php } ?>
                                    <?php if (!empty($propertyDetails['AdvertType']['name'])) { ?>
                                        <tr><td><strong><?php echo __("Contract");?></strong></td><td><?php echo $propertyDetails['AdvertType']['name']; ?></td></tr>
                                    <?php } ?>
                                    <?php if (!empty($propertyDetails['Property']['address'])) { ?>
                                        <tr><td><strong><?php echo __("Location");?></strong></td><td><?php echo $propertyDetails['Property']['address']; ?></td></tr>
                                    <?php } ?>
                                    <?php if (!empty($propertyDetails['Property']['bathrooms'])) { ?>
                                        <tr><td><strong><?php echo __("Bathrooms");?></strong></td><td><?php echo $propertyDetails['Property']['bathrooms']; ?></td></tr>
                                    <?php } ?>
                                    <?php if (!empty($propertyDetails['Property']['bedrooms'])) { ?>
                                        <tr><td><strong><?php echo __("Bedrooms");?></strong></td><td><?php echo $propertyDetails['Property']['bedrooms']; ?></td></tr>
                                    <?php } ?>
                                    <?php if (!empty($propertyDetails['Property']['size'])) { ?>
                                        <tr><td><strong><?php echo __("Area");?></strong></td><td><?php echo $propertyDetails['Property']['size']; ?>m<sup>2</sup></td></tr>
                                    <?php } ?>
                                </table>
                                <!--
                                <h3>Property Features</h3>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <ul>
                                            <li><i class="fa fa-check"></i>Air conditioning</li> 
                                            <li><i class="fa fa-check"></i>Balcony</li> 
                                            <li><i class="fa fa-times"></i>Bedding</li> 
                                            <li><i class="fa fa-check"></i>Cable TV</li> 
                                            <li><i class="fa fa-times"></i>Cleaning after exit</li> 
                                            <li><i class="fa fa-check"></i>Cofee pot</li> 
                                            <li><i class="fa fa-check"></i>Computer</li> 
                                            <li><i class="fa fa-times"></i>Cot</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <ul>
                                            <li><i class="fa fa-check"></i>Internet</li> 
                                            <li><i class="fa fa-times"></i>Iron</li> 
                                            <li><i class="fa fa-check"></i>Juicer</li> 
                                            <li><i class="fa fa-times"></i>Lift</li> 
                                            <li><i class="fa fa-times"></i>Microwave</li> 
                                            <li><i class="fa fa-check"></i>Oven</li> 
                                            <li><i class="fa fa-times"></i>Parking</li> 
                                            <li><i class="fa fa-times"></i>Parquet</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <ul>
                                            <li><i class="fa fa-times"></i>Radio</li> 
                                            <li><i class="fa fa-check"></i>Roof terrace</li> 
                                            <li><i class="fa fa-times"></i>Smoking allowed</li> 
                                            <li><i class="fa fa-check"></i>Terrace</li> 
                                            <li><i class="fa fa-times"></i>Toaster</li> 
                                            <li><i class="fa fa-check"></i>Towelwes</li> 
                                            <li><i class="fa fa-check"></i>Use of pool</li> 
                                            <li><i class="fa fa-check"></i>Video</li>
                                        </ul>
                                    </div>
                                </div>
                                -->
                                <h3><?php echo __("Property Description");?></h3>
                                <?php if (!empty($propertyDetails['Property']['description'])) {
                                    echo $propertyDetails['Property']['description'];
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-md-pull-9 sidebar">
                <?php echo $this->element("sidebar"); ?>
            </div>
        </div>
    </div>
</div>