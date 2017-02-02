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
        <a class="btn btn-primary pull-right" href="/admin/properties/manage/detail/"><?php echo __('Aggiungi Proprietà'); ?></a>
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
                        <th class="sorting">Nome</th>
                        <th class="sorting">Codice</th>
                        <th>Anteprima</th>
                        <th class="sorting">Proprietario</th>
                        <th class="sorting">Indirizzo</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $toDelete = array();
                    if (isset($Properties)) {
                        foreach ($Properties as $key => $property) {
                            $custom_link = strtolower(Inflector::slug($property['Property']['title'], '-'));
                            $plugin = $this->params['plugin'];
                            $controller = $this->params['controller'];
                            ?>
                            <tr class="<?php echo ($key % 2 == 0) ? 'even' : 'odd'; ?>">
                                <td><input type="checkbox" class="check" name="list[]" value="<?=$property["Property"]["id"]?>" /></td>
                                <td><?php echo $property['Property']['title']; ?></td>
                                <td><?php echo $property['Property']['code']; ?></td>
                                <td><a target="_blank" href="http://<?=$_SERVER['HTTP_HOST']?>/properties/<?=$property['Property']['id']?>/<?=$custom_link?>">Preview</a></td>
                                <td><?php echo $property['Client']['name']; ?> <?php echo $property['Client']['surname']; ?></td>
                                <td><?php echo Common::dotdotdot($property['Property']['address'], 100); ?></td>
                                <td>
                                    <a class="btn btn-primary btn-xs" href="/admin/<?=$plugin;?>/<?=$controller;?>/gallery/<?=$property['Property']['id']; ?>" title="Add Gallery">
                                    <span class="glyphicon glyphicon-picture"></span></a>
                                    <a class="btn btn-warning btn-xs" href="/admin/<?=$plugin;?>/<?=$controller;?>/detail/<?=$property['Property']['id']; ?>" title="Edit">
                                    <span class="glyphicon glyphicon-edit"></span></a>
                                    <a class="btn btn-danger btn-xs" onclick='confirmDelete("<?=$plugin;?>","<?=$controller;?>","delete","<?=$property['Property']['id'];?>")' href="#" title="Delete">
                                    <span class="glyphicon glyphicon-remove"></span></a>
                                    <?php if (!$property['Property']['is_published']) { ?>
                                    <a class="btn btn-info btn-xs" href="/admin/properties/manage/publish/<?=$property['Property']['id'];?>" title="Publish">
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
