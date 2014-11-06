<?php

namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends BaseType {

    protected $dataClass = 'Acme\\DemoBundle\\Entity\\Product';

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('_type', 'hidden', array(
            'data' => $this->getName(),
            'mapped' => true
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => $this->dataClass,
            'model_class' => $this->dataClass,
        ));
    }

    public function getName() {
        return 'product_type';
    }

}
