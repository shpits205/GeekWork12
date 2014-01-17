<?php


namespace Acme\TestBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TagsType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('textTag', 'text', array('label' => 'tags t'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Acme\TestBundle\Entity\Tags',
                'csrf_protection' => true,
            ));
    }

    public function getName()
    {
        return 'tags';
    }

}