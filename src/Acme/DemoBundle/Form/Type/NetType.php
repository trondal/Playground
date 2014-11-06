<?php

namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NetType extends AbstractType {

    protected $dataClass =  'Acme\\DemoBundle\\Entity\\Net';
    //protected $modelClass = '';
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->add('number', 'text')
                ->add('orgId', 'text')
                ->add('_type', 'hidden', [
                    'data' => $this->getName(),
                    'mapped' => false
        ]);
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\\DemoBundle\\Entity\\Net',
            'model_class' => 'Acme\\DemoBundle\\Entity\\Net'
        ));
    }
    
    public function getParent() {
        return 'product_type';
    }
    
    public function getName() {
        return 'net_type';
    }

}
