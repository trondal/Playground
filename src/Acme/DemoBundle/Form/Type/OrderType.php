<?php

namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrderType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ribollitaId', 'text')
                ->add('products', 'infinite_form_polycollection', array(
                    'types' => array(
                        'mobile_type',
                        'net_type'
                    ),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => true,
                    'prototype' => true,
                    'cascade_validation' => true
                ))
                ->add('_type', 'hidden', [
                    'data' => $this->getName(),
                    'mapped' => false
                ]);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\\DemoBundle\\Entity\\Order',
            'csrf_protection'   => false,
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'order_type';
    }

}
