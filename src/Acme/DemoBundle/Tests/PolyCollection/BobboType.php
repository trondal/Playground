<?php

namespace Acme\DemoBundle\Tests\PolyCollection;

use Infinite\FormBundle\Tests\PolyCollection\Type\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BobboType extends AbstractType {

    protected $dataClass = 'Acme\\DemoBundle\\Tests\\PolyCollection\\Bobbo';

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->add('text2', 'text');
    }

    public function getName() {
        return 'bobbo_type';
    }

}
