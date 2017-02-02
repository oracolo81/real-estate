<? if (isset($sTitle)) { ?>
    <?php echo $this->element("admin/title", array("title" => $sTitle)); ?>
<? } 
?>

<div class="row admin-buttons-placeholder">
    <div class="col-lg-6 col-lg-offset-6 col-md-6 col-md-offset-6 col-xs-12">
    </div>
</div>

<div class="row admin-buttons-placeholder">
    <div class="col-lg-6 col-lg-offset-6 col-md-6 col-md-offset-6 col-xs-12">
        <a class="btn btn-primary pull-right" href="/admin/galleries/manage/detail/"><?php echo __('Add Gallery'); ?></a>
    </div>
</div>

<?php echo $this->element('notices'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                <table class="table table-striped table-bordered table-hover dataTable no-footer">
                <thead>
                    <tr role="row">
                        <th><input type="checkbox" id="checkAll" /></th>
                        <th>Thumb</th>
                        <th class="sorting">Category</th>
                        <th class="sorting" width="50%">Caption</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $toDelete = array();
                        foreach ($galleries as $key => $gallery) {
                            $plugin = $this->params['plugin'];
                            $controller = $this->params['controller'];
                            ?>
                            <tr class="<?php echo ($key % 2 == 0) ? 'even' : 'odd'; ?>">
                                <td><input type="checkbox" class="check" name="list[]" value="<?=$gallery["Gallery"]["id"]?>" /></td>
                                <td><img class="img-thumb" src="<?=$path.$gallery['Gallery']['file_name']?>" alt="Thumbnail" /></td>
                                <td><?php echo $gallery['CategoriesGallery']['name'];?></td>
                                <td><?php echo Common::dotdotdot($gallery['Gallery']['description'], 100); ?></td>
                                <td>
                                    <a class="btn btn-warning btn-xs" href="/admin/<?=$plugin;?>/<?=$controller;?>/detail/<?=$gallery['Gallery']['id']; ?>" title="Edit">
                                    <span class="glyphicon glyphicon-edit"></span></a>
                                    <a class="btn btn-danger btn-xs" onclick='confirmDelete("<?=$plugin;?>","<?=$controller;?>","delete","<?=$gallery['Gallery']['id'];?>")' href="#" title="Delete">
                                    <span class="glyphicon glyphicon-remove"></span></a>
                                </td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>