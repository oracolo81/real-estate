<?php echo $this->element("admin/title", array("title" => '<i class="fa fa-dashboard fa-fw"></i> Dashboard')); ?>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-align-left fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $pagesCount; ?></div>
                        <div>Pages</div>
                    </div>
                </div>
            </div>
            <a href="/admin/pages/manage/detail">
                <div class="panel-footer">
                    <span class="pull-left">Add Page</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-home fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $propertiesCount; ?></div>
                        <div>Properties</div>
                    </div>
                </div>
            </div>
            <a href="/admin/properties/manage/detail">
                <div class="panel-footer">
                    <span class="pull-left">Add Property</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-picture-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $galleriesCount; ?></div>
                        <div>Galleries</div>
                    </div>
                </div>
            </div>
            <a href="/admin/galleries/manage/detail">
                <div class="panel-footer">
                    <span class="pull-left">Add Gallery</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>