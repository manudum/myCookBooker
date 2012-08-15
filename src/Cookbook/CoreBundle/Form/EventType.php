<?php

namespace Cookbook\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

class EventType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name','text', array(
                'attr' => array('placeholder' => 'Nouvel événement'),
            ))
            ->add('date', 'date', array(
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'dd/MM/yyyy',
                'attr' => array('class' => 'date'),
                ))
            ->add('description', 'textarea', array('required' => false,))
            ->add('friends', 'entity', array(
                'attr' => array('style' => 'width: 600px;height:100px;'),
                'class' => 'CookbookCoreBundle:Friend',
                'query_builder' => function(EntityRepository $repository) use($options) {
                return $repository->createQueryBuilder('q')
                    ->where('q.people = '.$options['user_id'])
                    ->orderBy('q.name');
                },
                'empty_value' => 'Choose an option',
                'required' => false,
                'multiple' => true,
            ))
            ->add('recipes', 'entity', array(
                'attr' => array('style' => 'width: 600px;height:100px;'),
                'class' => 'CookbookCoreBundle:Recipe',
                'query_builder' => function(EntityRepository $repository) use($options) {
                return $repository->createQueryBuilder('q')
                    ->where('q.people = '.$options['user_id'])
                    ->orderBy('q.category')
                    ->orderBy('q.name');
                },
                'empty_value' => 'Choose an option',
                'required' => false,
                'multiple' => true,
            ))
        ;
    }

    public function getName()
    {
        return 'cookbook_corebundle_recipetype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Cookbook\CoreBundle\Entity\Event',
            'user_id'         => null,
        );
    }
}
