<?php

namespace Acme\DemoBundle\Tests\PolyCollection;

use Infinite\FormBundle\Tests\PolyCollection\Model\AbstractModel;

class Bobbo extends AbstractModel {

    public $checked;

    public function __construct($text = null, $checked = false) {
        parent::__construct($text);
        $this->checked = $checked;
    }
    
    public function getText2() {
        return $this->text;
    }

}
