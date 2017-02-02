<?php 
    $paginator = $this->Paginator;
?>
<?php echo $this->element("quick_search"); ?>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading-title heading-title-alt">
                            <h3><?php echo __("Property meeting the search criteria"); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row sort">
                    <div class="col-md-4 col-sm-4 col-xs-3">
                        <a href="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="btn btn-warning"><i class="fa fa-th"></i></a>
                        <a href="<?php echo $_SERVER["REQUEST_URI"]; ?>?list=1" class="btn btn-default"><i class="fa fa-list"></i></a>
                        <span><? echo $this->Paginator->counter(array('format' => 'Show <strong>%pages%</strong> of <strong>%count%</strong> result'));?></span>
                    </div> 
                    <div class="col-md-8 col-sm-8 col-xs-9">
                        <form class="form-inline" role="form">
                            <span>Sort by : </span>
                            <div class="form-group">
                                <label class="sr-only" for="sortby">Sort by : </label>
                                <select class="form-control">
                                    <option>Most Recent</option>
                                    <option>Price (Low &gt; High)</option>
                                    <option>Price (High &gt; Low)</option>
                                    <option>Most Popular (Low &gt; High)</option>
                                </select>
                            </div>
                            <span>Show : </span>
                            <div class="form-group">
                                <label class="sr-only" for="show">Show : </label>
                                <select class="form-control">
                                    <option>6</option>
                                    <option>10</option>
                                    <option>15</option>
                                    <option>20</option>
                                    <option>25</option>
                                    <option>50</option>
                                    <option>100</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row container-realestate">
                    <?php if (!empty($properties)) { ?>
                        <?php foreach ($properties as $key => $property) {
                            $custom_link = strtolower(Inflector::slug($property['Property']['title'], '-'));
                            $plugin = $this->params['plugin'];
                            ?>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="property-container">
                                    <a href="http://<?=$_SERVER['HTTP_HOST']?>/properties/<?=$property['Property']['id']?>/<?=$custom_link?>">
                                        <div class="property-image">
                                            <?php if ($property['DefaultImage']['file_name'] != "") {
                                                $pic_url = "/properties/img/" . $property['DefaultImage']['file_name'];
                                            } else {
                                                $pic_url ="/img/no-picture.gif";
                                            }?>
                                            <img src="<?=$this->Html->url($pic_url);?>" alt="mikha real estate theme">
                                            <div class="property-price">
                                                <h4><?=$property['Property']['title'];?></h4>
                                                <?php if (!empty($property['Property']['price'])) { ?>
                                                    <span>&euro;<?php echo $property['Property']['price']; ?></span>
                                                <?php } ?>
                                            </div>
                                            <?php if (!empty($property['AdvertType']['name'])) { ?>
                                                <div class="property-status"><span><?php echo $property['AdvertType']['name']; ?></span></div>
                                            <?php } ?>
                                        </div>
                                    </a>
                                    <div class="property-features">
                                        <?php if (!empty($property['Property']['size'])) { ?>
                                            <span><i class="fa fa-home"></i><?php echo $property['Property']['size']; ?> m<sup>2</sup></span>
                                        <?php } ?>
                                        <?php if (!empty($property['Property']['bedrooms'])) { ?>
                                            <span><i class="fa fa-hdd-o"></i><?php echo $property['Property']['bedrooms']; ?> <?php echo __("Bed"); ?></span>
                                        <?php } ?>
                                        <?php if (!empty($property['Property']['bathrooms'])) { ?>
                                            <span><i class="fa fa-male"></i><?php echo $property['Property']['bathrooms']; ?> <?php echo __("Bath"); ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="property-content">
                                        <h3><a href="#">Office</a> 
                                        <?php if (!empty($property['Property']['address'])) { ?>
                                            <small><?php echo $property['Property']['address']; ?></small>
                                        <?php } ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="pagination">
                        <?php
                            if($paginator->hasPrev()){
                                echo $paginator->prev("<<", array('tag' => 'li'));
                            }
                            // the 'number' page buttons
                            echo $paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));

                            if($paginator->hasNext()){
                                echo $paginator->next(">>", array('tag' => 'li'));
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-md-pull-9 sidebar">
                <?php echo $this->element("sidebar"); ?>
            </div>
        </div>
    </div>
</div>
