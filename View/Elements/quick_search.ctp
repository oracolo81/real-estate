<div id="header" class="heading" style="background-image: url(<?=$this->Html->url('/img/img01.jpg');?>);">
    <div class="container">
        <form id="searchForm" action="/properties/search" method="post" role="form">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="quick-search">
                        <div class="row">
                            <form role="form">
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter keyword...">
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option>On Sale</option>
                                            <option>For Rent</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option>1</option><option>2</option>
                                            <option>3</option><option>4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option>Villa</option>
                                            <option>Recident</option>
                                            <option>Commercial</option>
                                        </select>
                                    </div>
                                    <div class="form-group"> 
                                        <select class="form-control">
                                            <option>$4,200</option><option>$6,700</option>
                                            <option>$8,150</option><option>$11,110</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option>$8,200</option><option>$11,700</option>
                                            <option>$14,150</option><option>$21,110</option>
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
                        <li class="active">Villa</li>
                    </ol>
                </div>
            </div>
        </form>
    </div>
</div>