<div class="widget-white favorite">
    <a href="#"><i class="fa fa-heart"></i><?php echo __("Add to favorite");?></a>
</div>
<div class="widget widget-sidebar widget-white">
    <div class="widget-header">
        <h3><?php echo __("Recent Property");?></h3>
    </div>
    <ul>
        <?php
        if (!empty($latestProperties)) {
            foreach ($latestProperties as $property) { 
                $custom_link = strtolower(Inflector::slug($property['Property']['title'], '-'));
                ?>
                <li><a href="http://<?=$_SERVER['HTTP_HOST']?>/properties/<?=$property['Property']['id']?>/<?=$custom_link?>"><?= $property['Property']['title'] ?></a></li>
                <?php 
            } 
        } ?>
    </ul>
</div>
<!--
<div class="widget widget-sidebar widget-white">
    <div class="widget-header">
        <h3><?php echo __("Property Type");?></h3>
    </div>
    <ul class="list-check">
        <li><a href="#">Office</a>&nbsp;(18)</li> 
        <li><a href="#">Office</a>&nbsp;(43)</li> 
        <li><a href="#">Shop</a>&nbsp;(31)</li> 
        <li><a href="#">Villa</a>&nbsp;(52)</li> 
        <li><a href="#">Apartment</a>&nbsp;(8)</li> 
        <li><a href="#">Single Family Home</a>&nbsp;(11)</li>
    </ul>
</div>
<div class="widget widget-sidebar widget-white">
    <div class="widget-header">
        <h3>Top Agents</h3>
    </div>
    <ul>
        <li><a href="#">John Doe</a></li> 
        <li><a href="#">Christoper Drew</a></li> 
        <li><a href="#">Jane Doe</a></li> 
        <li><a href="#">Jeny</a></li>
    </ul>
</div>
-->