<?php

namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MobileType extends AbstractType {

    protected $dataClass = 'Acme\\DemoBundle\\Entity\\Mobile';
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->add('number', 'text');
    }
    
    public function getName() {
        return 'mobile_type';
    }

}
