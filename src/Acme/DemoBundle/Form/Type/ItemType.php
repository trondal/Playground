<?php

namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemType extends BaseType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', 'text')
                ->add('groups', 'collection', array(
                    'type' => new GroupType(),
                    'allow_add' => true,
                    'by_reference' => false,
                    'label' => ' '
                ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\\DemoBundle\\Entity\\Item',
            'label' => ' '
        ));
    }

    public function getName() {
        return 'item';
    }

}
