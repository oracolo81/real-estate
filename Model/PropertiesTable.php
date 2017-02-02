<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

class PropertiesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Translate', ['fields' => ['title', 'description']]);
    }
}

class Property extends Entity
{
    use TranslateTrait;
}
