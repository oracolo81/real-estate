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
        <a class="btn btn-primary pull-right" href="/admin/pages/manage/detail/"><?php echo __('Add Page'); ?></a>
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
                        <th class="sorting">Name</th>
                        <th>Link</th>
                        <th class="sorting" width="50%">Body</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $toDelete = array();
                        foreach ($pages as $key => $page) {
                            $custom_link = strtolower(Inflector::slug($page['Page']['name'], '-'));
                            $plugin = $this->params['plugin'];
                            $controller = $this->params['controller'];
                            ?>
                            <tr class="<?php echo ($key % 2 == 0) ? 'even' : 'odd'; ?>">
                                <td>
                                <?php if (!in_array($page['Page']['name'], $hardcodedPages)) { ?>
                                    <input type="checkbox" class="check" name="list[]" value="<?=$page["Page"]["id"]?>" />
                                <?php } ?>
                                </td>
                                <td><?php echo $page['Page']['name']; ?></td>
                                <td><a target="_blank" href="http://<?=$_SERVER['HTTP_HOST']?><?=(!in_array($page['Page']['name'], $hardcodedPages)) ? '/'.$plugin.'/'.$page['Page']['id'] : ''?>/<?=$custom_link?>">http://<?=$_SERVER['HTTP_HOST']?><?=(!in_array($page['Page']['name'], $hardcodedPages)) ? '/'.$plugin.'/'.$page['Page']['id'] : ''?>/<?=$custom_link?></a></td>
                                <td><?php echo Common::dotdotdot($page['Page']['body'], 100); ?></td>
                                <td>
                                    <a class="btn btn-warning btn-xs" href="/admin/<?=$plugin;?>/<?=$controller;?>/detail/<?=$page['Page']['id']; ?>" title="Edit">
                                    <span class="glyphicon glyphicon-edit"></span></a>
                                    <?php if (!in_array($page['Page']['name'], $hardcodedPages)) { ?>
                                        <a class="btn btn-danger btn-xs" onclick='confirmDelete("<?=$plugin;?>","<?=$controller;?>","delete","<?=$page['Page']['id'];?>")' href="#" title="Delete"><span class="glyphicon glyphicon-remove"></span></a>
                                    <?php } ?>
                                </td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
