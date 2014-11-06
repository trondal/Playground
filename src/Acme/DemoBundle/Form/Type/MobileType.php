<?php

namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MobileType extends AbstractType {

    protected $dataClass = 'Acme\\DemoBundle\\Entity\\Mobile';
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->add('number', 'text');
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\\DemoBundle\\Entity\\Mobile',
            'model_class' => 'Acme\\DemoBundle\\Entity\\Mobile'
        ));
    }
    
    public function getName() {
        return 'mobile_type';
    }

}