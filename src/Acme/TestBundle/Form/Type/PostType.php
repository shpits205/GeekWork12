<?php


namespace Acme\TestBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label' => 'Title'))
            ->add('category', 'text', array('label' => 'Category'))
            ->add('textPost', 'textarea', array('label' => 'Your Post'))
            ->add('tag', 'collection', array(
                'type' => new TagsType(),
                'allow_add' => true,
                'by_reference' => false,
            ))
        ->
        add('post', 'submit', array('label' => 'save!'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\TestBundle\Entity\Post',
            'csrf_protection' => true,
        ));
    }

    public function getName()
    {
        return 'post';
    }

}