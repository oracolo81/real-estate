<div id="service">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Best Real Estate Deals <small>You need to do is very simple just join us</small></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="service-container">
					<div class="service-icon"><a href="#"><i class="fa fa-home"></i></a></div>
					<div class="service-content">
						<h3>Lorem ipsum dolor sit</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="service-container">
					<div class="service-icon"><a href="#"><i class="fa fa-thumbs-up"></i></a></div>
					<div class="service-content">
						<h3>Lorem ipsum dolor sit</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="service-container">
					<div class="service-icon"><a href="#"><i class="fa fa-umbrella"></i></a></div>
					<div class="service-content">
						<h3>Lorem ipsum dolor sit</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="service-container">
					<div class="service-icon"><a href="#"><i class="fa fa-lock"></i></a></div>
					<div class="service-content">
						<h3>Lorem ipsum dolor sit</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
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
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="property-container">
						<?php if ($property['DefaultImage']['file_name'] != "") {
							$pic_url = "/properties/img/" . $property['DefaultImage']['file_name'];
						} else {
							$pic_url ="/img/no-picture.gif";
						}?>
						<a href="http://<?=$_SERVER['HTTP_HOST']?>/properties/<?=$property['Property']['id']?>/<?=$custom_link?>" class="property-image" style='background-image: url("<?=$this->Html->url($pic_url);?>")'>
							<div class="property-price"><h4>Residential</h4><span><i class="fa fa-eur"></i> <?=$property['Property']['price'];?></span></div>
							<div class="property-status"><span><?=$property['PropertyType']['name'];?></span></div>
						</a>
						<div class="property-content">
							<h3><a href="http://<?=$_SERVER['HTTP_HOST']?>/properties/<?=$property['Property']['id']?>/<?=$custom_link?>" ><?=$property['Property']['title'];?></a> <small><?=$property['Property']['address'];?></small></h3>
							<p><?=Common::dotdotdot($property['Property']['description'], 125);?></p>
						</div>
						<div class="property-features">
							<span><i class="fa fa-codepen"></i> <?=$property['Property']['size'];?> m<sup>2</sup></span> 
							<span><i class="fa fa-bed"></i> <?=$property['Property']['bedrooms'];?> <? echo __("Bedrooms");?></span>
						</div>
						<span class="strip oblique">nuovo</span>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="heading-title"><h2>Properties</h2></div>
			</div>
		</div>
		<div class="row">
			<?php foreach ($aProperties as $key => $property) { 
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
							<div class="property-price"><h4>Residential</h4><span><i class="fa fa-eur"></i> <?=$property['Property']['price'];?></span></div>
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