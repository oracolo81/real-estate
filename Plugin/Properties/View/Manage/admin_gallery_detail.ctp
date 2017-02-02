<?php if (isset($sTitle)) {
    echo $this->element("admin/title", array("title" => $sTitle));
    echo $this->element('notices'); 
}
?>
<form action="/admin/properties/manage/save_gallery" enctype="multipart/form-data" class="validateForm" role="form" method="post" autocomplete=off>
<?php if (isset($propertyId)) { ?>
    <input type="hidden" value="<?=$propertyId; ?>" name="data[PropertyImage][property_id]" />
<?php } ?>
<?php if (isset($propertyImages)) { ?>
    <input type="hidden" value="<?=$propertyImages["PropertyImage"]['id']; ?>" name="data[PropertyImage][id]" />
    <div class="form-group">
        <label class="control-label" for="thumbnail">Miniatura</label><br />
        <img id="thumbnail" class="img-thumb" src="<?=$path.$propertyImages['PropertyImage']['file_name']?>" alt="Thumbnail" />
    </div>
<?php } ?>
    <div class="form-group">
        <label class="control-label" for="file_name">Nome file</label>
        <input id="file_name" class="form-control required" name="data[PropertyImage][file_name]" type="file" value="<?=isset($propertyImages) ? $propertyImages['PropertyImage']['file_name'] : ''?>" title="File" accept="image/jpg,image/png,image/jpeg,image/gif" />
    </div>

    <div class="form-group">
        <label class="control-label" for="description">Testo</label>
        <textarea id="description" rows='5' class="form-control required" name="data[PropertyImage][description]" title="Write the caption"><?= isset($propertyImages) ? $propertyImages['PropertyImage']['description'] : ''; ?></textarea>
    </div>

    <input type="submit" class="btn btn-success" value="Salva" />
    <input type="button" class="btn btn-warning" value="Cancella" onclick="window.location='/admin/properties/manage/gallery/<?=$propertyId; ?>'" />
</form>