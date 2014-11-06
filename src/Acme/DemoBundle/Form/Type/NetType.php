<?php

namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NetType extends AbstractType {

    protected $dataClass =  'Acme\\DemoBundle\\Entity\\Net';
    //protected $modelClass = '';
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->add('number', 'text');
        $builder->add('orgId', 'text');
    }
    
    public function getName() {
        return 'net_type';
    }

}
