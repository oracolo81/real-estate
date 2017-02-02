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
        <a class="btn btn-primary pull-right" href="/admin/notifications/manage/detail/"><?php echo __('Add Notification'); ?></a>
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
                        <th class="sorting">Title</th>
                        <th>Link</th>
                        <th class="sorting" width="50%">Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $toDelete = array();
                    if (isset($notifications)) {
                        foreach ($notifications as $key => $notification) {
                            $custom_link = strtolower(Inflector::slug($notification['Notification']['title'], '-'));
                            $plugin = $this->params['plugin'];
                            $controller = $this->params['controller'];
                            ?>
                            <tr class="<?php echo ($key % 2 == 0) ? 'even' : 'odd'; ?>">
                                <td><input type="checkbox" class="check" name="list[]" value="<?=$notification["Notification"]["id"]?>" /></td>
                                <td><?php echo $notification['Notification']['title']; ?></td>
                                <td><a target="_blank" href="http://<?=$_SERVER['HTTP_HOST']?>/notifications/<?=$notification['Notification']['id']?>/<?=$custom_link?>">http://<?=$_SERVER['HTTP_HOST']?>/notifications/<?=$notification['Notification']['id']?>/<?=$custom_link?></a></td>
                                <td><?php echo Common::dotdotdot($notification['Notification']['description'], 100); ?></td>
                                <td>
                                    <a class="btn btn-warning btn-xs" href="/admin/<?=$plugin;?>/<?=$controller;?>/detail/<?=$notification['Notification']['id']; ?>" title="Edit">
                                    <span class="glyphicon glyphicon-edit"></span></a>
                                    <a class="btn btn-danger btn-xs" onclick='confirmDelete("<?=$plugin;?>","<?=$controller;?>","delete","<?=$notification['Notification']['id'];?>")' href="#" title="Delete">
                                    <span class="glyphicon glyphicon-remove"></span></a>
                                    <?php if (!$notification['Notification']['is_published']) { ?>
                                    <a class="btn btn-info btn-xs" href="/admin/notifications/manage/publish/<?=$notification['Notification']['id'];?>" title="Publish">
                                    <i class="fa fa-external-link fa-fw"></i></a>
                                    <?php } ?> 
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
