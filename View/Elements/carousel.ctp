<?php if (count($carousel)) { ?>
<div id="homecarousel" class="carousel slide hidden-xs" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php for ($i = 0; $i < count($carousel); $i++) { ?>
            <li data-target="#homecarousel" data-slide-to="<?php echo $i; ?>" <?php echo ($i == 0) ? 'class="active"' : ''; ?>></li>
        <?php } ?>
    </ol>
    <div class="carousel-inner">
        <?php foreach ($carousel as $key => $carouselItem) { ?>
            <div class="item <?php echo ($key == 0) ? 'active' : ''; ?>" onclick="window.location = '/product/<?php echo $carouselItem['Product']['id']; ?>/<?php echo Inflector::slug($carouselItem['Product']['title']); ?>'" style="background-image: url('<?php echo (!empty($carouselItem['Product']['mainImage'])) ? $carouselItem['Product']['mainImage']['ProductImage']['image'] : $carouselItem['ProductImage'][0]['image']; ?>')">
                <div class="container">
                    <div class="carousel-caption">
                        <h2><a href="/product/<?php echo $carouselItem['Product']['id']; ?>/<?php echo Inflector::slug($carouselItem['Product']['title']); ?>"><?php echo $carouselItem['Product']['title']; ?></a></h2>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <a class="left carousel-control" href="#homecarousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#homecarousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
<?php } ?>