<?php if (isset($sTitle)) {
    echo $this->element("admin/title", array("title" => $sTitle));
    echo $this->element('notices'); 
}
if(!empty($propertyDetails)) {
    $custom_link = strtolower(Inflector::slug($propertyDetails['Property']['title'], '-'));
}
$type_editor = Configure::read('type_editor');
?>
<form action="/admin/properties/manage/save" enctype="multipart/form-data" class="validateForm" role="form" method="post" autocomplete=off>
    <?php if (isset($propertyDetails)) { ?>
        <input type="hidden" value="<?=$propertyDetails["Property"]['id']; ?>" name="data[Property][id]" />
        <input type="hidden" value="<?=$propertyDetails["Client"]['id']; ?>" name="data[Client][id]" />
        <label class="control-label" for="title">URL</label>
        <div class="form-group">
            <a target="_blank" href="http://<?=$_SERVER['HTTP_HOST']?>/properties/<?=$propertyDetails['Property']['id']?>/<?=$custom_link?>">http://<?=$_SERVER['HTTP_HOST']?>/properties/<?=$propertyDetails['Property']['id']?>/<?=$custom_link?></a>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label class="control-label" for="title">Titolo Italiano</label>
                <input id="title" class="form-control required" name="data[Property][title][ita]" type="text" value="<?=isset($propertyDetails) ? $propertyDetails['Property']['title'] : ''?>" data-toggle="tooltip"  data-placement="top" title="Write the property title" />
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label class="control-label" for="title-eng">Titolo Inglese</label>
                <input id="title-eng" class="form-control required" name="data[Property][title][eng]" type="text" value="<?=isset($propertyDetails) ? $propertyDetails['Property']['title'] : ''?>" data-toggle="tooltip"  data-placement="top" title="Write the property title" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label class="control-label" for="description">Descrizione Italiano</label>
                <textarea id="description" rows='5' class="form-control" name="data[Property][description][ita]" title="Write the content of the property"><?= isset($propertyDetails) ? $propertyDetails['Property']['description'] : ''; ?></textarea>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label class="control-label" for="description-eng">Descrizione Inglese</label>
                <textarea id="description-eng" rows='5' class="form-control" name="data[Property][description][eng]" title="Write the content of the property"><?= isset($propertyDetails) ? $propertyDetails['Property']['description'] : ''; ?></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label class="control-label" for="advert_type">Tipo Annuncio</label>
                <select class="form-control required" id="advert_type" name="data[Property][advert_type_id]">
                    <option value="">Tipo Annuncio</option>
                    <option <?=(!empty($propertyDetails) && $propertyDetails["Property"]["advert_type_id"] == 1) ? "selected" : "";?> value="1">In vendita</option>
                    <option <?=(!empty($propertyDetails) && $propertyDetails["Property"]["advert_type_id"] == 2) ? "selected" : "";?> value="2">In affitto</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="code">Codice</label>
                <input id="code" class="form-control" name="data[Property][code]" type="text" value="<?php echo isset($propertyDetails) ? $propertyDetails['Property']['code'] : ''; ?>" data-toggle="tooltip"  data-placement="top" title="Write the code" />
            </div>
            <div class="form-group">
                <label class="control-label" for="address">Indirizzo</label>
                <textarea id="address" rows='5' class="form-control" name="data[Property][address]" data-toggle="tooltip"  data-placement="top" title="Write your address"><?php echo isset($propertyDetails) ? $propertyDetails['Property']['address'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label class="control-label" for="price">Prezzo</label>
                <input id="price" class="form-control" name="data[Property][price]" type="text" value="<?php echo isset($propertyDetails) ? $propertyDetails['Property']['price'] : ''; ?>" data-toggle="tooltip"  data-placement="top" title="Write the prize" />
            </div>
            <div class="form-group">
                <label class="control-label" for="size">Dimensione (mq)</label>
                <input id="size" class="form-control" name="data[Property][size]" type="text" value="<?php echo isset($propertyDetails) ? $propertyDetails['Property']['size'] : ''; ?>" data-toggle="tooltip"  data-placement="top" title="Write the size" />
            </div>
            <div class="form-group">
                <label class="control-label" for="bedrooms">Camere da letto</label>
                <select class="form-control required" id="bedrooms" name="data[Property][bedrooms]">
                    <option value="">N. bedrooms</option>
                    <?php 
                    for ($i=1; $i < 8; $i++) { 
                        if (isset($propertyDetails) && ($propertyDetails['Property']['bedrooms'] == $i) ) { ?>
                            <option selected value="<?=$i;?>"><?=$i;?></option>
                        <?php } else { ?>
                            <option value="<?=$i;?>"><?=$i;?></option>
                        <?php }    
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="bathrooms">Bagni</label>
                <select class="form-control required" id="bathrooms" name="data[Property][bathrooms]">
                    <option value="">N. bathrooms</option>
                    <?php 
                    for ($i=1; $i < 8; $i++) { 
                        if ( isset($propertyDetails) && ($propertyDetails['Property']['bathrooms'] == $i) ) { ?>
                            <option selected value="<?=$i;?>"><?=$i;?></option>
                        <?php } else { ?>
                            <option value="<?=$i;?>"><?=$i;?></option>
                        <?php }    
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="condition">Condizioni:</label>
                <select class="form-control required" id="condition" name="data[Property][property_condition]">
                    <?php 
                    $selected_new = "";
                    $selected_used = "";
                    if (isset($propertyDetails)) {
                        if ($propertyDetails['Property']['property_condition'] == "new") {
                            $selected_new = "selected";
                            $selected_used = "";
                        } else if ($propertyDetails['Property']['property_condition'] == "used") {
                            $selected_new = "";
                            $selected_used = "selected";
                        }
                    } ?>
                    <option value="">Condition</option>
                    <option <?=$selected_new;?> value="new">Nuova</option>
                    <option <?=$selected_used;?> value="used">Usata</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label class="control-label" for="property-category">Categoria</label>
                <select class="form-control required" id="property-category" name="data[Property][property_category_id]">
                    <option value="">Categoria</option>
                    <?php
                    foreach ($propertyCategories as $key => $value) {
                        if ( isset($propertyDetails) && ($propertyDetails['Property']['property_category_id'] == $key) ) { ?>
                            <option data-category-id="<?=$key;?>" value="<?=$key;?>" selected><?=$value;?></option>
                        <?php } else { ?>
                            <option data-category-id="<?=$key;?>" value="<?= $key; ?>"><?= $value; ?></option>
                        <?php }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="property-type">Tipo</label>
                <select class="form-control required" id="property-type" name="data[Property][property_type_id]">
                    <option value="">Tipo</option>
                    <?php if (!empty($propertyTypes)) {
                        foreach ($propertyTypes as $propertyType) {
                            $selected = false;
                            if (isset($propertyDetails) && ($propertyDetails['Property']['property_type_id'] == $propertyType["PropertyType"]["id"])) {
                                $selected = true;
                            }
                        ?>
                        <option data-property-category-id="<?=$propertyType["PropertyType"]["property_category_id"]?>" value="<?=$propertyType["PropertyType"]["id"]?>"<?=($selected)?" selected='selected'":""?>><?=$propertyType["PropertyType"]["name"]?></option>
                        <?php
                        }
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="type">Località</label>
                <select class="form-control" id="type" name="data[Property][local_council_id]">
                    <option value="">Località</option>
                    <?php
                    if (!empty($locations)) {
                        foreach ($locations as $location) {
                            $selected = false;
                            if (isset($propertyDetails) && ($propertyDetails['Property']['local_council_id'] == $location["LocalCouncil"]["id"]) ) {
                                $selected = true;
                            }
                        ?>
                        <option value="<?=$location["LocalCouncil"]["id"]?>"<?=($selected)?" selected='selected'":""?>><?=$location["LocalCouncil"]["nome"]?></option>
                        <?php
                        }
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="map-canvas">Posizione</label>
                <p>Clicca sulla mappa per indicare la posizione.</p>
                <div id="map-canvas" style="width: auto; height: 380px;"></div>
                <input id="googleSearchBox" class="controls" type="text" placeholder="Search Box">
                <input type="hidden" id="latitude" name="data[Property][latitude]" value="<?=((!empty($propertyDetails))?$propertyDetails["Property"]["latitude"]:"")?>"/>
                <input type="hidden" id="longitude" name="data[Property][longitude]" value="<?=((!empty($propertyDetails))?$propertyDetails["Property"]["longitude"]:"")?>"/>
                <button type="button" class="btn btn-sm btn-danger pull-right" id="btnRemoveLocation" onclick="removeLocation();">Rimuovi posizione</button>
            </div>
        </div>
    </div>
    <hr class="soften" />
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label class="control-label" for="name">Nome</label>
                <input id="name" class="form-control" name="data[Client][name]" type="text" value="<?php echo isset($propertyDetails) ? $propertyDetails['Client']['name'] : ''; ?>" data-toggle="tooltip"  data-placement="top" title="Name" />
            </div>
            <div class="form-group">
                <label class="control-label" for="surname">Cognome</label>
                <input id="surname" class="form-control" name="data[Client][surname]" type="text" value="<?php echo isset($propertyDetails) ? $propertyDetails['Client']['surname'] : ''; ?>" data-toggle="tooltip"  data-placement="top" title="Surname" />
            </div>
            <div class="form-group">
                <label class="control-label" for="address">Indirizzo proprietario</label>
                <input id="address" class="form-control" name="data[Client][address]" type="text" value="<?php echo isset($propertyDetails) ? $propertyDetails['Client']['address'] : ''; ?>" data-toggle="tooltip"  data-placement="top" title="Owner's address" />
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label class="control-label" for="telephone">N. Telefono</label>
                <input id="telephone" class="form-control" name="data[Client][telephone]" type="text" value="<?php echo isset($propertyDetails) ? $propertyDetails['Client']['telephone'] : ''; ?>" data-toggle="tooltip"  data-placement="top" title="Telephone number" />
            </div>
            <div class="form-group">
                <label class="control-label" for="mobile">N. Cellulare</label>
                <input id="mobile" class="form-control" name="data[Client][mobile]" type="text" value="<?php echo isset($propertyDetails) ? $propertyDetails['Client']['mobile'] : ''; ?>" data-toggle="tooltip"  data-placement="top" title="Write your mobile number" />
            </div>
            <div class="form-group">
                <label class="control-label" for="email">Email</label>
                <input id="email" class="form-control" name="data[Client][email]" type="text" value="<?php echo isset($propertyDetails) ? $propertyDetails['Client']['email'] : ''; ?>" data-toggle="tooltip"  data-placement="top" title="Write your email address" />
            </div>
        </div>
    </div>
    <input type="submit" class="btn btn-success" value="Salva" />
    <?php if (isset($propertyDetails) && !$propertyDetails['Property']['is_published']) { ?>
        <input type="button" class="btn btn-info" value="Pubblica" onclick="window.location='/admin/properties/manage/publish/<?=$propertyDetails["Property"]['id']; ?>'" />
    <?php } ?>
    <input type="button" class="btn btn-warning" value="Cancella" onclick="window.location='/admin/properties/manage/index'" />
</form>
<?php if($type_editor == "markup") { ?>
    <script src="/js/bootstrap-markdown/lib/markdown.js"></script>
    <script src="/js/bootstrap-markdown/lib/to-markdown.js"></script>
<?php } ?> 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=<?=Configure::read('google.api_key');?>"></script>
<script type="text/javascript">
    var lat = <?=((!empty($propertyDetails) && !empty($propertyDetails["Property"]["latitude"]))?$propertyDetails["Property"]["latitude"]:"null")?>;
    var lon = <?=((!empty($propertyDetails) && !empty($propertyDetails["Property"]["longitude"]))?$propertyDetails["Property"]["longitude"]:"null")?>;
    
    google.maps.event.addDomListener(window, 'load', function(){
        initAdminMap(lat, lon);
    });
</script>