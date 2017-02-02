<?php
class Gallery extends GalleriesAppModel {
	public $name = 'Gallery';

	public $belongsTo = array(
        'CategoriesGallery' => array(
            'className' => 'CategoriesGallery',
            'foreignKey' => 'category_id'
        )
    );
}
?>