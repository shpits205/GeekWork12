<?php


namespace Acme\TestBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Name'))
            ->add('email', 'text', array('label' => 'E-mail'))
            ->add('message', 'textarea', array('label' => 'Your message'))
            ->add('post', 'submit', array('label' => 'Fire!'));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Acme\TestBundle\Entity\Book',
                'csrf_protection' => true,
            ));
    }

    public function getName()
    {
        return 'book';
    }

}