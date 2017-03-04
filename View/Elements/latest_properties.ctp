
<div id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading-title"><h2>Latest Properties</h2></div>
			</div>
		</div>
		<div class="row">
			<?php foreach ($latestProperties as $key => $property) { 
				$custom_link = strtolower(Inflector::slug($property['Property']['title'], '-'));
				?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="property-container">
						<?php if ($property['DefaultImage']['file_name'] != "") {
							$pic_url = "/properties/img/" . $property['DefaultImage']['file_name'];
						} else {
							$pic_url ="/img/no-picture.gif";
						}?>
						<a href="http://<?=$_SERVER['HTTP_HOST']?>/properties/<?=$property['Property']['id']?>/<?=$custom_link?>" class="property-image" style='background-image: url("<?=$this->Html->url($pic_url);?>")'>
							<div class="property-price"><h4><?=$property['PropertyCategory']['name'];?></h4><span><i class="fa fa-eur"></i> <?=$property['Property']['price'];?></span></div>
							<div class="property-status"><span><?=$property['PropertyType']['name'];?></span></div>
						</a>
						<div class="property-features">
							<span><i class="fa fa-codepen"></i> <?=$property['Property']['size'];?> m<sup>2</sup></span> 
							<span><i class="fa fa-bed"></i> <?=$property['Property']['bedrooms'];?> <? echo __("Bedrooms");?></span> 
						</div>
						<div class="property-content">
							<h3><a href="http://<?=$_SERVER['HTTP_HOST']?>/properties/<?=$property['Property']['id']?>/<?=$custom_link?>"><?=$property['Property']['title'];?></a> 
							<small><?=$property['Property']['address'];?></small></h3>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>